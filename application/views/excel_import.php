<html>
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

	<title>Registrar com excel 
</title>
</head>
<body>
	<h1>registrar com excel </h1>
	
	<div class="container">
   <?php
	echo form_open_multipart('excel-import/import-data');
	echo form_upload('file');
	echo '<br/>';
	echo '<br/>';
	echo form_submit(null, 'Upload');
	echo
	
	form_close();
	?>
</div>
	 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>