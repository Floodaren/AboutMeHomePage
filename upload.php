<?php
    include 'databaseconnection.php';
    $target_dir = "uploadSlutprojekt/";
    $descriptionError = "";
    if (isset($_POST['fileDescription']) && $_POST['fileDescription'] != "")
    {
        if (isset($_FILES["fileToUpload"]["name"]))
        {
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $filename = basename($_FILES["fileToUpload"]["name"]);
            $fileDescription = $_POST['fileDescription'];
            $uploadOk = 1;
            $fileType = pathinfo($target_file,PATHINFO_EXTENSION);
            
            if(isset($_POST["uploadfile"])) 
            {
                    $uploadOk = 1;
            }
            if (file_exists($target_file)) 
            {
                echo "Filen finns redan eller så har du inte valt någon fil!<br>";
                $uploadOk = 0;
            }
            
            if ($_FILES["fileToUpload"]["size"] > 200000000) 
            {
                echo "Filen är över 2MB<br>";
                $uploadOk = 0;
            }
            /*
            This part will not be in use for the moment because i want all the file types to be accepted
            if($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg"
            && $fileType != "gif" && $fileType != "rtf" && $fileType != "php" && $fileType != "html" && $fileType != "css"
            && $fileType != "zip") 
            {
                echo "Filformatet godkänns inte, försök med en annan fil";
                $uploadOk = 0;
            }
            */
            
            if ($uploadOk == 0) 
            {
                echo "Filen laddades inte upp<br>";   
            }
            else 
            {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
                {
                    $user = "Admin";
                    chmod($target_file, 0644);
                    $dbInsert = new dbManagement;
                    $dbInsert->newFile($user,$target_file,$filename,$fileDescription);
                    header("Refresh:0");
                } 
                else 
                {
                    echo "Något gick tyvärr fel, försök igen";
                }
            }
        }     
    }
    else 
    {
        $descriptionError = "Description is required";
    }
?>
<div>
    <a data-toggle='modal' data-target='#uploadfileform' class="btn btn-success" id="upLoadButton">Upload a new file</a>        
    <form action="manageUploadedFiles.php" id='uploadfileForm' method='post' enctype="multipart/form-data">
        <div class='modal fade' id='uploadfileform' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>×</span>
                        <span class='sr-only'>Close</span></button>
                        <h4 class='modal-title' id='myModalLabel2'>Upload a new file</h4>
                    </div>
                    <div class='modal-body'>
                        <div class='form-group has-feedback'>
                            <label class='control-label'>Choose and describe the file</label>
                            <input type='file' class='form-control' name="fileToUpload" id="fileToUpload" aria-describedby='inputSuccess2Status'>
                            <!--<label class='control-label'>File description <strong>(Remember to zip your files)</strong></label>-->
                            <input type='text' class='form-control' name="fileDescription" id="fileDescriptionID" aria-describedby='inputSuccess2Status' placeholder='Description for file'> <?php echo "<small>($descriptionError)</small>" ?>
                            <span class='glyphicon glyphicon-ok form-control-feedback' aria-hidden='true'></span>
                        </div>
                        <input type='submit' name='uploadfile' class='btn btn-primary' value='Upload'>             
                    </div>
                </div>
            </div>
        </div>
    </form>  
</div>
