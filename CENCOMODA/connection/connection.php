<?php
 # ________
 #| |____| |
 #|   __   |
 #|  (__)  |
 #|        |
 #|________|
    class Database
    {
        public $con;
        private $server = "localhost";
        private $user = "postgres";
        private $password = "juantem20";
        private $database = "db_cencomoda";

        public function __construct()
        {
            $this->connectionDb();
        }

        // ----------------------------------------------------------------
        // METODO PARA CREAR LA CONEXION A LA BASE DE DATOS.
        // ----------------------------------------------------------------
        private function connectionDb()
        {
            $connectString = "host=". $this->server ." dbname=". $this->database ." user=". $this->user ." password=". $this->password;
            $this->con = pg_connect($connectString);

            if (!$this->con) {
                echo "Ha ocurrido un problema";
            }
        }

        ////////////////////////////////////////////////////////////////
        ////////////////////////// UTILIDADES //////////////////////////
        ////////////////////////////////////////////////////////////////

        public function desinfectarVariable($var)
        {
            $return = pg_escape_string($this->con ,$var);
            return $return;
        }

        private function construirSentenciaUpdate($tablaBD, $valores, $id)
        {
            $sql = "$tablaBD SET ";
            $columnas = $this->con->query("SHOW COLUMNS FROM $tablaBD");
            $i = 0;

            while ($field = $columnas->fetch_assoc())
            {
                if (str_contains($field['Field'], '_id'))
                {
                    $valorId = $field["Field"];
                }

                if (!str_contains($field['Field'], '_id'))
                {
                    $sql .= $field["Field"]."='".$valores[$i-1]."'";

                    if (count($valores) <= $i)
                    {
                        $sql .= " WHERE $valorId='$id'";
                    }
                    else
                    {
                        $sql .= ",";
                    }
                }
                $i++;
            }

            return $sql;
        }

        private function construirSentenciaInsert($tablaBD, $valores)
        {
            $sql = "$tablaBD (";
            $columnas = pg_query($this->con, "SELECT column_name FROM information_schema.columns WHERE table_schema = 'public'
                AND table_name = '". $tablaBD ."'");
            $i = 0;

            while ($field = pg_fetch_assoc($columnas))
            {
                $sql .= $field['column_name'];
                if (count($valores) <= $i)
                {
                    $sql .= ") VALUES (";
                    for ($i=0; $i <= count($valores) ; $i++)
                    {
                        if ($i == 0)
                        {
                            $sql .= "nextval('id_". strtolower($tablaBD) ."'::regclass),";
                        }
                        else
                        {
                            $sql .= "'".$valores[$i-1]."'";

                            if (count($valores) <= $i)
                            {
                                $sql .= ")";
                            }
                            else
                            {
                                $sql .= ",";
                            }
                        }

                    }
                }
                else
                {
                    $sql .= ",";
                }
                $i++;
            }

            return $sql;
        }

        public function ejecutarSentencia($sql)
        {
            $result = pg_query($this->con, $sql);

            if ($result)
            {
                return $result;
            }
            else
            {
                print "El nombre de la tabla, campo, o id no existe en la base de datos.";
            }
        }

        ////////////////////////////////////////////////////////////////
        //////////////////////////// LOGIN /////////////////////////////
        ////////////////////////////////////////////////////////////////
        public function login($usuario, $contrasena)
        {
            session_start();

            $usuario = $this->desinfectarVariable($usuario);
            $contrasena = $this->desinfectarVariable($contrasena);

            $sql = "SELECT * FROM tab_registrousu
                WHERE usuario = '$usuario'
                AND contrasena = '". md5($contrasena) ."'";

            $result = pg_query($this->con, $sql);
            $cantRows = pg_num_rows($result);
            if ($cantRows > 0)
            {
                $_SESSION['usuario'] = $usuario;
                header('Location:connection/login.php');
            }
            else
            {
                return "No hay un usuario registrado";
            }
        }

        ////////////////////////////////////////////////////////////////
        ///////////////////////////// CRUD /////////////////////////////
        ////////////////////////////////////////////////////////////////

        // ----------------------------------------------------------------
        // METODO PARA INSERTAR UN REGISTRO A UNA TABLA.
        //
        // @return: verdadero o falso la ejecucion de la insercion.
        // ----------------------------------------------------------------
        public function insertarGestion($tablaBD, $datos)
        {
            foreach ($datos as $indice => $valores[]) {
                if (gettype($valores[$indice]) == "integer")
                {
                    $valores[$indice] = intval($valores[$indice]);
                }
                else
                {
                    $valores[$indice] = $this->desinfectarVariable($valores[$indice]);
                }
            }
            $sql = "INSERT INTO ". $this->construirSentenciaInsert($tablaBD, $valores);

            if (pg_query($this->con, $sql))
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        // ----------------------------------------------------------------
        // METODO PARA CONSULTAR UNO O VARIOS REGISTROS DE UNA TABLA.
        //
        // Metodo Sobrecargado:
        // 1 @param -> consultarGestiones($tablaBD)
        // 2 @param -> consultarGestiones($tablaBD, $datoIdBD)
        //
        // @return: el resultado de busqueda en la base de datos.
        // ----------------------------------------------------------------
        public function consultarGestion()
        {
            $args = func_get_args();
            $columnas = pg_query($this->con, "SELECT column_name FROM information_schema.columns WHERE table_schema = 'public'
                AND table_name = '". $args[0] ."'");

            while ($field = pg_fetch_assoc($columnas))
            {
                if (str_contains($field['column_name'], 'id_'))
                {
                    $valorId = $field["column_name"];
                }
            }

            if (count($args) == 1)
            {
                $args[0] = $this->desinfectarVariable($args[0]);
                $sql = "SELECT * FROM ". $args[0] ." ORDER BY $valorId DESC LIMIT 1";
            }
            else if (count($args) == 2)
            {
                $args[0] = $this->desinfectarVariable($args[0]);
                $args[1] = $this->desinfectarVariable($args[1]);
                $sql = "SELECT * FROM $args[0] WHERE $valorId = '$args[1]'";
            }
            $result = pg_query($this->con, $sql);

            if ($result)
            {
                return $result;
            }
            else
            {
                print "El nombre de la tabla, campo, o id no existe en la base de datos.";
            }
        }

        // ----------------------------------------------------------------
        // METODO PARA EDITAR ALGUN REGISTRO DE UNA TABLA.
        //
        // @return: verdadero o falso la ejecucion de la edicion.
        // ----------------------------------------------------------------
        public function editarGestion($tablaBD, $datos, $id)
        {
            foreach ($datos as $indice => $valores[]) {
                if (gettype($valores[$indice]) == "integer")
                {
                    $valores[$indice] = intval($valores[$indice]);
                }
                else
                {
                    $valores[$indice] = $this->desinfectarVariable($valores[$indice]);
                }
            }
            $sql = "UPDATE ".$this->construirSentenciaUpdate($tablaBD, $valores, $id);

            if ($this->con->query($sql))
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        // ----------------------------------------------------------------
        // METODO PARA ELIMINAR ALGUN REGISTRO DE UNA TABLA.
        //
        // @return: verdadero o falso la ejecucion de la eliminacion.
        // ----------------------------------------------------------------
        public function eliminarGestion($tablaBD, $id)
        {
            $datos = $this->con->query("SHOW COLUMNS FROM $tablaBD");

            while ($field = $datos->fetch_assoc()) {
                if (str_contains($field['Field'], '_estado'))
                {
                    $campoEstado = $field['Field'];
                }
                elseif (str_contains($field['Field'], '_id'))
                {
                    $campoId = $field['Field'];
                }
            }
            $sql = "UPDATE $tablaBD SET $campoEstado='2' WHERE $campoId='$id'";

            if ($this->con->query($sql))
            {
                return true;
            }
            else
            {
                return false;
            }
        }

    }
?>