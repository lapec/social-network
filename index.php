<!DOCTYPE html>
<html>
<head>
	<title>social network</title>
	<link href="css/style.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
</head>
<body>
 <header>
  <nav>
   <div id="navContent">
     social Network 
     <form action="dashboard.php" method="post">
     <input type="text" name="username" placeholder="Unesite korisnicko ime" /> | <input type="password" name="password" placeholder="Unesite sifru">
         <input type="submit" name="login" value="Login" />
     </form>
   </div>
  </nav>
 </header>
 <main>
    { Mreža za nove software developer-e }
 </main>
 <aside>
 	Registracija
    <form action="index.php">
      <input type="text" name="name" placeholder="Unesite vaše ime" autocomplete="off" /><br/>
      <input type="text" name="lastname" placeholder="Unesite vaše prezime" autocomplete="off" /><br/>
      <input type="text" name="email" placeholder="Unesite vaš email" autocomplete="off" /><br/>
      <input type="text" name="username" placeholder="Unesite vaše korisničko ime" autocomplete="off" /><br/>
      <input type="text" name="password" placeholder="Unesite vašu lozinku" autocomplete="off" /><br/><br/>
      <input type="submit" name="submit" />
    </form>
 </aside>
</body>
</html>