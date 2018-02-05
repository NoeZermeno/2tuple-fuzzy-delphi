<?php
function getItem($index){
$table= [] ;   

$table[0]['num'] = 1;
$table[0]['item'] = 'A través del trabajo colaborativo he obtenido orientaciones explícitas para centrarme en los contenidos del curso.Escala a utilizar: Tipo A';
$table[0]['CC'] = 4.28	;
$table[0]['CW'] = 4.76	;
$table[0]['CP'] = 4.76	;
$table[0]['CAS'] = 5.13;
$table[0]['score'] = 4.73;
$table[0]['Total'] = 'Very correct';

$table[1]['num'] = 2;
$table[1]['item'] = 'Estoy satisfecho con las actividades propuestas en el curso.Escala a utilizar: Tipo B';
$table[1]['CC'] = 4.93;
$table[1]['CW'] = 4.58;
$table[1]['CP'] = 4.82;
$table[1]['CAS'] = 4.34;
$table[1]['score'] = 4.67;
$table[1]['Total'] = 'Very correct';

$table[2]['num'] = 3;
$table[2]['item'] = 'Estoy satisfecho con la información aportada por mis compañeros.Escala a utilizar: Tipo B';
$table[2]['CC'] = 4.46;
$table[2]['CW'] = 4.70;
$table[2]['CP'] = 4.70;
$table[2]['CAS'] = 4.46;
$table[2]['score'] = 4.58;
$table[2]['Total'] = 'Very correct';

$table[3]['num'] = 4;
$table[3]['item'] = 'Estoy satisfecho con las respuestas recibidas a mis preocupaciones. preguntas y necesidades relacionadas con los temas tratados en el curso.Escala a utilizar: Tipo B';
$table[3]['CC'] = 4.25;
$table[3]['CW'] = 4.25;
$table[3]['CP'] = 4.43;
$table[3]['CAS'] = 4.22;
$table[3]['score'] = 4.29;
$table[3]['Total'] = 'Correct';

$table[4]['num'] = 5;
$table[4]['item'] = 'Estoy satisfecho porque pude expresar mis preocupaciones. preguntas y necesidades relacionadas con los temas tratados en el curso.Escala a utilizar: Tipo B';
$table[4]['CC'] = 4.45;
$table[4]['CW'] = 4.21;
$table[4]['CP'] = 4.63;
$table[4]['CAS'] = 4.33;
$table[4]['score'] = 4.40;
$table[4]['Total'] = 'Correct';

$table[5]['num'] = 6;
$table[5]['item'] = 'Estoy satisfecho con los acuerdos adoptados en las actividades colaborativas. Escala a utilizar: Tipo B"';
$table[5]['CC'] = 4.37;
$table[5]['CW'] = 4.09;
$table[5]['CP'] = 4.49;
$table[5]['CAS'] = 4.63;
$table[5]['score'] = 4.39;
$table[5]['Total'] = 'Correct';

$table[6]['num'] = 7;
$table[6]['item'] = 'Estoy satisfecho con los resúmenes realizados en las actividades del curso.Escala a utilizar: Tipo B';
$table[6]['CC'] = 4.46;
$table[6]['CW'] = 4.34;
$table[6]['CP'] = 4.46;
$table[6]['CAS'] = 4.46;
$table[6]['score'] = 4.43;
$table[6]['Total'] = 'Correct';

$table[7]['num'] = 8;
$table[7]['item'] = 'Considero que he alcanzado los objetivos del curso.Escala a utilizar: Tipo B';
$table[7]['CC'] = 4.76;
$table[7]['CW'] = 4.64;
$table[7]['CP'] = 4.64;
$table[7]['CAS'] = 4.22;
$table[7]['score'] = 4.57;
$table[7]['Total'] = 'Correct';

$table[8]['num'] = 9;
$table[8]['item'] = 'Estoy satisfecho porque he podido expresar emociones. satisfacción. bromas. ironías. etc.Escala a utilizar: Tipo B';
$table[8]['CC'] = 4.42;
$table[8]['CW'] = 4.42;
$table[8]['CP'] = 4.30;
$table[8]['CAS'] = 4.39;
$table[8]['score'] = 4.38;
$table[8]['Total'] = 'Correct';

$table[9]['num'] = 10;
$table[9]['item'] = 'Estoy satisfecho porque he podido demostrar gratitud con algún miembro del grupo.Escala a utilizar: Tipo B';
$table[9]['CC'] = 4.32;
$table[9]['CW'] = 4.32;
$table[9]['CP'] = 4.20;
$table[9]['CAS'] = 4.04;
$table[9]['score'] = 4.22;
$table[9]['Total'] = 'Correct';

 
        return $table[$index];
    }
?>

