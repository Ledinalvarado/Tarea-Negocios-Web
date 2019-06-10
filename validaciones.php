<?php

function validar($datos, $arc){
    $archivo = explode('.',$arc['imagen']['name']);
    $nombre = '';
    $extension = $archivo[count($archivo)-1];

    for($i = 0;$i < (count($archivo)-1);$i++){
        $nombre = $nombre . $archivo[$i] . '.';
    }

    $nombre_final = $nombre . time() . '-' . mt_rand(1000,9999) . '.' . $extension;
    $url = 'imagenes/' . $nombre_final;
    move_uploaded_file($arc['imagen']['tmp_name'], $url);

    $numero_cuenta=$datos['numero_cuenta'] ?? '';
    $primer_nombre=$datos['primer_nombre'] ?? '';
    $apellido=$datos['apellido'] ?? '';
    $correo=$datos['correo'] ?? '';
    $dia=$datos['dia'] ?? '';
    $mes=$datos['mes'] ?? '';
    $year=$datos['year'] ?? '';

    $errores = [];
    if (empty($numero_cuenta) or mb_strlen($numero_cuenta)!=13){

        $errores[]='El numero de cuenta debe contener exactamente 13 caracteres';

    }

    if (empty($primer_nombre) or mb_strlen($primer_nombre)>20){
        $errores[]='El primer nombre no debe estar vacio y debe ser menor a 20 caracteres';
    }

    if (empty($apellido) or mb_strlen($apellido)>20){
        $errores[]='El apellido  no debe estar vacio y debe ser menor a 20 caracteres';
    }

    if (empty($correo) or mb_strlen($correo)>100){
        $errores[]='El correo no debe estar vacio y debe ser menor a 100 caracteres';
    }


    $fecha = $year.'-'.$mes.'-'.$dia;


    if (count($errores)===0){
        try{
            $pdo= new PDO('mysql:dbname=matricula;host=127.0.0.1','root','1234');
            $stmt= $pdo->prepare("INSERT INTO estudiantes(numero_cuenta,primer_nombre,apellido,
                            fecha_nacimiento,correo,nombre_imagen
                            )VALUE (?,?,?,?,?,?)");
            $stmt->bindValue(1,$numero_cuenta);
            $stmt->bindValue(2,$primer_nombre);
            $stmt->bindValue(3,$apellido);
            $stmt->bindValue(4,$fecha);
            $stmt->bindValue(5,$correo);
            $stmt->bindValue(6,$url);
            $stmt->execute();
            echo "Guardado";
        }catch (PDOException $e){
            echo $e->getMessage();
        }
    }else{
        for($i=0;$i<count($errores);$i++){
            echo $errores[$i] . '<br>';
        }
    }



}