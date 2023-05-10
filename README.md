# API Generazione Panini

La seguente API-REST consente di gestire la registrazione e l'accesso agli utenti che potranno ordinare il loro panino.

## Cosa fornisce la nostra API?

- Consultare la lista degli ingredienti , invocando il file php Ingredients.php
- Registrare un utente invocando il file Register.php, passando come paremetri username e pw (name e password). Se la richiesta va a buon fine verrà restituito un token importante perché mediante questo sarà possibile ordinare i panini e consultare la lista di panini ordinati.
- Accedere come utente precedentemente registrato invocando il file Login.php, passando come paremetri username e pw (name e password). Se la richiesta va a buon fine verrà restituito il token relativo all'utente.
- Consultare i panini ordinati (lo storico degli ordini) relativo ad uno specifico utente invocando il file Orders.php e passando tramite get o post il token (es URL?token=1234). Se la richiesta andrà a buon fine verrà restituito appunto lo storico dei panini.
- Ordinare dei panini invocando il file Purchase.php e passando tramite get il token relativo ad un utente già registrato e tramite post la lista dei panini da ordinare che dovrà avere la formattazione indicata nel file dummy.json . Se la richiesta andrà a buon fine verrà ritornato il saldo rimanente relativo all'utente.

E ORA PROGRAMMATORE BUONO SVILUPPO DELLA TUA APPLICAZIONE DI BURGER SHOP!!!
