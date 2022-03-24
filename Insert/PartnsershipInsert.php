<?php
session_start();

include("../connection.php");
include("../functions.php");


$user_data = check_login($con);

if(isset($_POST['submit']))
{
    $test = $user_data['UserId'];
    $check = "SELECT SubmissionId FROM submission WHERE UserId = '$test' AND (SubmissionStatus = 'Ongoing' OR SubmissionStatus = 'Submitted') AND QuarterId = (SELECT QuarterId FROM quarter WHERE QuarterProgress='Ongoing')";
    $result = mysqli_query($con, $check);
    $row = mysqli_fetch_assoc($result);
    $id = $row['SubmissionId'];
    
    $title = $_FILES["file"]["name"];
    $pname = rand(1000,10000)."-".$_FILES["file"]["name"];
    $tname = $_FILES["file"]["tmp_name"];
    $uploads_dir = '../uploads/'.$pname;
    move_uploaded_file($tname, $uploads_dir);

    $partnershiptitle = $_POST['partnershiptitle'];
    $type = $_POST['type'];
    $nature = $_POST['nature'];
    $deliverable = $_POST['deliverable'];
    $target = $_POST['target'];
    $level = $_POST['level'];

    $datefrom = $_POST['datefrom'];
    $dateto = $_POST['dateto'];

    $contactname = $_POST['contactname'];
    $contacttel = $_POST['contacttel'];
    $address = $_POST['address'];
    
    $change = $_POST['change'];

    if($change!=null)
    {
        $check = ("SELECT PartnershipId FROM partnership WHERE PartnershipId = '$change'");
        $result = mysqli_query($con,$check);
        if($result->num_rows == 0)
        {
            $sql = "INSERT INTO partnership (SubmissionId,PartnershipTitle,PartnershipType,PartnershipNature,PartnershipDeliverable,PartnershipBeneficiaries,PartnershipLevel,PartnershipDateFrom,PartnershipDateTo,PartnershipContact,PartnershipTel,PartnershipAddress,PartnershipFilename,PartnershipTempName) VALUES ('$id','$partnershiptitle','$type','$nature','$deliverable','$target','$level','$datefrom','$dateto','$contactname','$contacttel','$address','$title','$pname');";
            mysqli_query($con,$sql);
            $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
            mysqli_query($con,$stat);
            header("Location: ../Partnerships.php?insert=success");
        }
        else
        {
            if($title==null)
            {
                $sql = ("UPDATE partnership SET SubmissionId ='$id',PartnershipTitle='$partnershiptitle',PartnershipType='$type',PartnershipNature='$nature',PartnershipDeliverable='$deliverable',PartnershipBeneficiaries='$target',PartnershipLevel='$level',PartnershipDateFrom='$datefrom',PartnershipDateTo='$dateto',PartnershipContact='$contactname',PartnershipTel='$contacttel',PartnershipAddress='$address' WHERE PartnershipId = '$change';");
                mysqli_query($con,$sql);
                header("Location: ../Partnerships.php?Record=$change");
            }
            else
            {
                $checkfile = ("SELECT PartnershipTempName FROM partnership WHERE PartnershipId = '$change'");
                $resultfile = mysqli_query($con,$checkfile);
                $updatefile = mysqli_fetch_assoc($resultfile);
                unlink("../uploads/".$updatefile);
                $sql = ("UPDATE partnership SET SubmissionId ='$id',PartnershipTitle='$partnershiptitle',PartnershipType='$type',PartnershipNature='$nature',PartnershipDeliverable='$deliverable',PartnershipBeneficiaries='$target',PartnershipLevel='$level',PartnershipDateFrom='$datefrom',PartnershipDateTo='$dateto',PartnershipContact='$contactname',PartnershipTel='$contacttel',PartnershipAddress='$address',PartnershipFilename='$title',PartnershipTempName='$pname' WHERE PartnershipId = '$change';");
                mysqli_query($con,$sql);
                header("Location: ../Partnerships.php?Record=$change");
            }

        }
    }

    else
    {
        $sql = "INSERT INTO partnership (SubmissionId,PartnershipTitle,PartnershipType,PartnershipNature,PartnershipDeliverable,PartnershipBeneficiaries,PartnershipLevel,PartnershipDateFrom,PartnershipDateTo,PartnershipContact,PartnershipTel,PartnershipAddress,PartnershipFilename,PartnershipTempName) VALUES ('$id','$partnershiptitle','$type','$nature','$deliverable','$target','$level','$datefrom','$dateto','$contactname','$contacttel','$address','$title','$pname');";
        mysqli_query($con,$sql);
        $stat = ("UPDATE addstat SET stat = 0 WHERE id = 1");
        mysqli_query($con,$stat);
        header("Location: ../Partnerships.php?insert=success");
    }

}
if(isset($_POST['reseter']))
{
    $change = $_POST['change'];
    if($change!=null)
    {
        $sql = "DELETE FROM partnership WHERE PartnershipId = $change";
        mysqli_query($con,$sql);
        header("Location: ../Partnerships.php");
    }
}

if(isset($_POST['add']))
{
    $stat = ("UPDATE addstat SET stat = 1 WHERE id = 1");
    mysqli_query($con,$stat);
    header("Location: ../Partnerships.php");
}

?>