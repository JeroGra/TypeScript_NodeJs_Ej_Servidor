<?php 
        class Alumno
        {
            public int $legajo;
            public string $apellido;
            public string $nombre;
            public string $foto;

            public function __construct(int $legajo, string $apellido, string $nombre, string $foto)
            {
                $this->legajo = $legajo;
                $this->apellido = $apellido;
                $this->nombre = $nombre;    
                $this->foto = $foto;   
            }

            //Creada de ante mano por si es necesario pasar el legajo como string
            public function lToString():string
            {
                return (string)$this->legajo;
            }
            //Creada de ante mano por si es necesario re convertir el legajo como int
            public function ParseL(string $num):int
            {
                return (int)$num;
            }


            public static function agregar(Alumno $obj) : bool 
            {
    
                $retorno = false;
        
                //ABRO EL ARCHIVO
                $ar = fopen("./archivos/alumnos.txt", "a");
        
                //ESCRIBO EN EL ARCHIVO 
                $cant = fwrite($ar, "{$obj->legajo}-{$obj->apellido}-{$obj->nombre}-{$obj->foto}\r\n");
        
                if($cant > 0)
                {
                    $retorno = true;			
                }
    
                //CIERRO EL ARCHIVO
                fclose($ar);
        
                return $retorno;
            }
    
            public static function listar() : string {
    
                $retorno = "";
        
                //ABRO EL ARCHIVO
                $ar = fopen("./archivos/alumnos.txt", "r");
        
                //LEO LINEA X LINEA DEL ARCHIVO 
                while(!feof($ar))
                {
                    $retorno .= fgets($ar);//."</br>" para mostrar en mensaje html		
                }
        
                //CIERRO EL ARCHIVO
                fclose($ar);
        
                return $retorno;
            }
    
            public static function verificar(int $legajo) : string {
    
                $retorno ="No se encontro el alumno con el legajo {$legajo}";
        
                //ABRO EL ARCHIVO
                $ar = fopen("./archivos/alumnos.txt", "r");
        
                //LEO LINEA X LINEA DEL ARCHIVO 
                while(!feof($ar))
                {
                    $linea = fgets($ar);
                    $array_linea = explode("-", $linea);
                    $array_linea[0] = trim($array_linea[0]);
                    if($array_linea[0] != ""){
                        //RECUPERO LOS CAMPOS
                        $legajo_archivo = trim($array_linea[0]);
                        $apellido_archivo = trim($array_linea[1]);
                        $nombre_archivo = trim($array_linea[2]);
                        $foto_archivo = trim($array_linea[3]);
                        if($legajo_archivo == $legajo)
                        {
                            $retorno = "El alumno con legajo {$legajo} se encuentra en el listado";
                            break;
                        }
                    }		
                }
        
                //CIERRO EL ARCHIVO
                fclose($ar);
        
                return $retorno;
            }
    
            public static function modificar(Alumno $obj) : bool {
    
                $retorno = false;
        
                $alumnos = array();
        
                //ABRO EL ARCHIVO
                $ar = fopen("./archivos/alumnos.txt", "r");
        
                //LEO LINEA X LINEA DEL ARCHIVO 
                while(!feof($ar))
                {
                    $linea = fgets($ar);
                    $array_linea = explode("-", $linea);
        
                    $array_linea[0] = trim($array_linea[0]);
        
                    if($array_linea[0] != ""){
                        //RECUPERO LOS CAMPOS
                        $legajo_archivo = trim($array_linea[0]);
                        $apellido_archivo = trim($array_linea[1]);
                        $nombre_archivo = trim($array_linea[2]);
                        $foto_archivo = trim($array_linea[3]);
        
                        if ($legajo_archivo == $obj->legajo) 
                        { 
                            array_push($alumnos, "{$legajo_archivo}-{$obj->apellido}-{$obj->nombre}-{$obj->foto}\r\n");
                        }
                        else
                        {
                            array_push($alumnos, "{$legajo_archivo}-{$apellido_archivo}-{$nombre_archivo}-{$foto_archivo}\r\n");
                        }
                    }
                }
        
                //CIERRO EL ARCHIVO
                fclose($ar);
        
                //ABRO EL ARCHIVO
                $ar = fopen("./archivos/alumnos.txt", "w");
        
                $cant = 0;
                
                //ESCRIBO EN EL ARCHIVO
                foreach($alumnos AS $item){
        
                    $cant = fwrite($ar, $item);
                }
        
                if($cant > 0)
                {
                    $retorno = true;			
                }
        
                //CIERRO EL ARCHIVO
                fclose($ar);
        
                return $retorno;
            }
    
            public static function borrar(int $legajo) : bool {
    
                $retorno = false;
        
                $alumnos = array();
        
                //ABRO EL ARCHIVO
                $ar = fopen("./archivos/alumnos.txt", "r");
        
                //LEO LINEA X LINEA DEL ARCHIVO 
                while(!feof($ar))
                {
                    $linea = fgets($ar);

                    $array_linea = explode("-", $linea);
        
                    $array_linea[0] = trim($array_linea[0]);
        
                    if($array_linea[0] != ""){
        
                        //RECUPERO LOS CAMPOS
                        $legajo_archivo = trim($array_linea[0]);
                        $apellido_archivo = trim($array_linea[1]);
                        $nombre_archivo = trim($array_linea[2]);
                        $foto_archivo = trim($array_linea[3]);
                        if ($legajo_archivo == $legajo) {
                            
                            continue;
                        }
        
                        array_push($alumnos, "{$legajo_archivo}-{$apellido_archivo}-{$nombre_archivo}-{$foto_archivo}\r\n");
                    }
                }
        
                //CIERRO EL ARCHIVO
                fclose($ar);
        
                $cant = 0;
        
                //ABRO EL ARCHIVO
                $ar = fopen("./archivos/alumnos.txt", "w");
        
                //ESCRIBO EN EL ARCHIVO
                foreach($alumnos AS $item){
        
                    $cant = fwrite($ar, $item);
                }
        
                if($cant > 0)
                {
                    $retorno = true;			
                }
        
                //CIERRO EL ARCHIVO
                fclose($ar);
        
                return $retorno;
            }
            public static function Obtener(int $legajo):Alumno
            {
                $alumno = new Alumno($legajo,"","","");
    
                $ar = fopen("./archivos/alumnos.txt", "r");           
                while(!feof($ar))
                {
                    $linea = fgets($ar);
                    $array_linea = explode("-", $linea);
                    $array_linea[0] = trim($array_linea[0]);
                    if($array_linea[0] != ""){
                        //RECUPERO LOS CAMPOS
                        $legajo_archivo = trim($array_linea[0]);
                        $apellido_archivo = trim($array_linea[1]);
                        $nombre_archivo = trim($array_linea[2]);
                        $foto_archivo = trim($array_linea[3]);
                        if($legajo_archivo == $legajo)
                        {
                            $alumno->apellido = $apellido_archivo;
                            $alumno->nombre = $nombre_archivo;
                            $alumno->foto = $foto_archivo;
                            break;
                        }
                    }		
               }
               fclose($ar);
               return $alumno;
           }

           public static function ArrayObjetos():array
           {        
                //ABRO EL ARCHIVO
                $ar = fopen("./archivos/alumnos.txt", "r");
                $alumnos = array();

                //LEO LINEA X LINEA DEL ARCHIVO 
              while(!feof($ar))
                {
                    $linea = fgets($ar);
                    $array_linea = explode("-", $linea);
        
                    $array_linea[0] = trim($array_linea[0]);
        
                    if($array_linea[0] != ""){

                        $alum = new Alumno((int)trim($array_linea[0]),trim($array_linea[1]),trim($array_linea[2]),trim($array_linea[3]));

                        array_push($alumnos,$alum);
                    }
                }
        
                //CIERRO EL ARCHIVO
                fclose($ar);
        
                return $alumnos;
           }

           public static function ListarTabla():string
           {

                $ar = fopen("./archivos/alumnos.txt", "r");
                $alumnos = "<table><tr><th>LEGAJO</th><th>APELLIDO</th><th>NOMBRE</th><th>FOTO</th></tr>";

                //LEO LINEA X LINEA DEL ARCHIVO 
                while(!feof($ar))
                {
                    $linea = fgets($ar);
                    $array_linea = explode("-", $linea);
                    $array_linea[0] = trim($array_linea[0]);
        
                    if($array_linea[0] != "")
                    {
                        $legajo = trim($array_linea[0]);
                        $apellido = trim($array_linea[1]);
                        $nombre = trim($array_linea[2]);
                        $foto = trim($array_linea[3]);

                        $alumnos .="<tr><td>{$legajo}</td><td>{$apellido}</td><td>{$nombre}</td><td><img src={$foto}/></td></tr>";
                    }
                }

                $alumnos .= "</table>";
                return $alumnos;
           }
        }
?>