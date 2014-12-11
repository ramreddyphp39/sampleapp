<!DOCTYPE html>
<html>
<head>
    <title>Successfully Uploaded</title>
    <style type="text/css">
        body {
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Your file was successfully uploaded</h2>
    <p>
        <?php echo anchor('http://localhost/ciapp/uploads/' . $upload_data['file_name'], 'Click here to view your upload') ?>
        <br />
        <?php echo anchor('upload', 'Upload Another File!'); ?>
    </p>
</body>
</html>