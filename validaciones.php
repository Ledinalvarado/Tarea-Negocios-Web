<?php

function validar($datos){

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
                            fecha_nacimiento,correo
                            )VALUE (?,?,?,?,?)");
            $stmt->bindValue(1,$numero_cuenta);
            $stmt->bindValue(2,$primer_nombre);
            $stmt->bindValue(3,$apellido);
            $stmt->bindValue(4,$fecha);
            $stmt->bindValue(5,$correo);
            $stmt->execute();
            return "Guardado";
        }catch (PDOException $e){
            echo $e->getMessage();
        }
    }else{
        for($i=0;$i<count($errores);$i++){
            echo $errores[$i] . '<br>';
        }
    }



}