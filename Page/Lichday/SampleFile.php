<?php
    $html='<table>
    <tr>
    <td>ID</td> 
    <td>Subject</td>
    <td>Day</td>
    <td>Room</td>
    <td>Lesson</td>
    <td>startStudying</td>
    <td>endStudying</td>
    <td>idTeacher</td>
    <td>IdUser</td>
    </tr>
    <tr>
    <td>1</td> 
    <td>Anh văn</td>
    <td>THỨ 3</td>
    <td>E1 02.02</td>
    <td>1-9</td>
    <td>19/07/2022</td>
    <td>19/10/2022</td>
    <td>2</td>
    <td>1</td>
    </tr>
    </table>';
    print_r($html);
    header('Content-Type:application/xls');
    header('Content-Disposition:attachment;filename=report.xls');
?>