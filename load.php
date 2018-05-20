<?php

function insertData($tableName, $filePath, $isAutoIncrement)
{
    include("DBConn.php");

    $subjectCodeData = file ($filePath);
    $fields = array();

    $res=$DBConnect->query("SHOW COLUMNS FROM ". $tableName);

    while ($row = $res->fetch_assoc())
    {
        $fields[] = $row['Field'];
    }

    if($isAutoIncrement == true)
        array_shift($fields);

    foreach ($subjectCodeData as $lineValue)
    {
        $query = buildQuery($tableName, $fields, $lineValue);
        //echo $query. "<br>";

        $QresultA = $DBConnect->query($query);
        if ($QresultA === FALSE)
            echo "<p> Unable to perform SQL Insert ".$query." &#10060; </p><br>";
        else
            echo "<p> ".$query. "&#9989;</p><br>";
    }
    $DBConnect->close();
}

function buildQuery($tableName, $fields, $lineValue)
{
    $query="INSERT INTO `".$tableName."` (";

    foreach ($fields as $index=>$f)
    {
        $query .= "`". $f . "`";

        if($index != count($fields) - 1)
            $query .= ",";

        if ($index == count($fields) - 1)
            $query .= ") VALUES (";
    }

    $valArray = explode(";", $lineValue);
    array_pop($valArray);

    foreach ($valArray as $index => $data)
    {
        $query .= "'". $data . "'";

        if($index != count($valArray) - 1)
            $query .= ",";

        if ($index == count($valArray) - 1)
            $query .= ")";
    }

    return $query;
}

insertData('staff', 'project data/staff.txt', true);
insertData('security_officer', 'project data/securityOfficer.txt', false);
insertData('lecturer', 'project data/lecturer.txt', false);
insertData('subject', 'project data/subject.txt', true);
insertData('subject_code', 'project data/subjectCode.txt', true);
insertData('assessment_type', 'project data/assessmentType.txt', true);
insertData('dates', 'project data/dates.txt', true);
insertData('assessment', 'project data/assessment.txt', true);
insertData('student', 'project data/student.txt', false);
insertData('venue_type', 'project data/venueType.txt', true);
insertData('venue', 'project data/venue.txt', true);
insertData('assessment_venue', 'project data/assessmentVenue.txt', false);
insertData('lecturer_subject', 'project data/lecturerSubject.txt', false);
insertData('student_register', 'project data/studentRegister.txt', false);
?>