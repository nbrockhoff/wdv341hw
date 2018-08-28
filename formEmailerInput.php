<!doctype html>
<html>
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>N.Brockhoff | Form Emailer</title>
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

        <h1>Form Emailer</h1>
        
    </div>
</div>
 <div class="row">
 <div class="small-10 small-offset-1 columns">
<form id="form1" name="form1" method="post" action="formEmailer.php">
  <p>First Name: 
    <input type="text" name="firstName" id="textfield" />
</p>
  <p>Last Name: 
    <input type="text" name="lastName" id="textfield2" />
  </p>
  <p>Email: 
    <input type="text" name="email" id="textfield3" />
  </p>
  <p>Potter:
    <label><input type="Radio" name="Potter" id="Lily" value="Lily"> Lily</label>
    <label><input type="Radio" name="Potter" id="James" value="James"> James</label>
    <label><input type="Radio" name="Potter" id="Harry" value="Harry"> Harry</label>
  </p>
  <p>Snape was an:
    <label><input type="checkbox" name="Ally"  value="True">Ally</label>
    <label><input type="checkbox" name="Enemy"  value="True">Enemy</label>
  </p>
  <p>House:
    <select name="House">
      <option value="Gryffindor">Gryffindor</option>
      <option value="Slytherin">Slytherin</option>
      <option value="Ravenclaw">Ravenclaw</option>
      <option value="Hufflepuff">Hufflepuff</option>
      
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
