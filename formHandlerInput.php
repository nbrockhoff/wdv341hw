<!doctype html>
<html>
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>N.Brockhoff | Form Handler</title>
<link rel="stylesheet" href="css/app.css">
    
</head>
<body>
 
<div class="top-bar">
    <div class="top-bar-left">
        <ul class="menu">
            <li class="menu-text">N.Brockhoff | Fall 2016</li>
            <li><a href="index.html">WDV341</a></li>
        </ul>
    </div>
</div>
 
<div class="callout large primary">
    <div class="row column text-center">

        <h1>Form Handler</h1>
        
    </div>
</div>
 <div class="row">
 <div class="small-10 small-offset-1 columns">
<form id="form1" name="form1" method="post" action="formHandler.php">
  <p>First Name: 
    <input type="text" name="firstName" id="textfield" />
</p>
  <p>Last Name: 
    <input type="text" name="lastName" id="textfield2" />
  </p>
  <p>School: 
    <input type="text" name="school" id="textfield3" />
  </p>
  <p>Lannister:
    <label><input type="Radio" name="Lannister" id="Cersei" value="Cersei"> Cersei</label>
    <label><input type="Radio" name="Lannister" id="Jaime" value="Jaime"> Jaime</label>
    <label><input type="Radio" name="Lannister" id="Tyrion" value="Tyrion"> Tyrion</label>
  </p>
  <p>Baseborn:
    <label><input type="checkbox" name="Baseborn-Waters"  id="Gendry" value="Gendry Waters">Gendry Waters</label>
    <label><input type="checkbox" name="Baseborn-Snow" id="Jon" value="Jon Snow">Jon Snow</label>
  </p>
  <p>Baratheon:
    <select name="Baratheon">
      <option value="Robert">Robert</option>
      <option value="Renly">Renly</option>
      <option value="Stannis">Stannis</option>
      
    </select>
  </p>
  <p>
    <input type="submit" name="button" id="button" value="Submit" />
    <input type="reset" name="button2" id="button2" value="Reset" />
  </p>
</form>
</div>
</div>
</body>

</html>
