<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Créer un billet EvenPass</title>
<style>
body { font-family: 'Segoe UI', sans-serif; background:#f0f4f8; display:flex; justify-content:center; align-items:center; height:100vh; }
.form-container { background:#fff; padding:30px 40px; border-radius:15px; box-shadow:0 10px 25px rgba(0,0,0,0.2); width:400px; }
h2 { text-align:center; margin-bottom:20px; }
input { width:100%; padding:10px; margin-bottom:15px; border-radius:8px; border:1px solid #ccc; font-size:1rem; }
button { width:100%; padding:12px; background:#4CAF50; color:white; border:none; font-size:1rem; border-radius:8px; cursor:pointer; }
button:hover { background:#45a049; }
</style>
</head>
<body>
<div class="form-container">
<h2>Créer un billet EvenPass</h2>
<form action="index.php" method="POST">
    <input type="text" name="nom" placeholder="Nom complet" required>
    <input type="text" name="event" placeholder="Nom de l'événement" required>
    <input type="text" name="place" placeholder="Place / Numéro de siège" required>
    <input type="text" name="lieu" placeholder="Lieu de l'événement" required>
    <input type="datetime-local" name="date_event" required>
    <button type="submit">Créer le billet</button>
</form>
</div>
</body>
</html>
