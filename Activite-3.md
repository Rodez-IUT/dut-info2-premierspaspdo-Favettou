Injection sql :
cela consiste à passer dans le formulaire un bout de code adapté au language (html, php, css, javascript...) 
utilisé pour la page et la page va interprété le résultat comme étant du code à lire (ici SQL). 
En html la balise htmlspecialchars permet de transformer les caractères spéciaux par leur code HTML entities 
ce qui empêche la page d'interpreter le formulaire comme du code HTML.