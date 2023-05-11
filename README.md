# API Generazione Panini

La seguente API-REST consente di gestire la registrazione e l'accesso agli utenti che potranno ordinare il loro panino e visualizzare lo storico.

LEGGETE TUTTO!!!

## Come raggiungere la nostra API

Per collegarsi sarà sufficiente raggiungere il nostro server Linux, hostato da Microsoft Azure (24/7), all'indirizzo ``20.31.133.144``.

Segue un esempio della richiesta per registrarsi:

``
20.31.133.144/Burger-shop/Register.php?name=Pippo&password=aH5n8#3
``

Risposta:

``
{"token":"g9876b#32à1"}
``

Poiché noi le cose le facciamo bene, i parametri possono essere passati sia con una **GET** (e quindi con i parametri nell'URL) o con la **POST** (con i parametri nel body), quest'ultima è più sicura e quindi consigliata.

## Cosa permette di fare la nostra API

- Consultare la lista degli ingredienti, invocando il file php ``Ingredients.php``.
- Registrare un utente invocando il file ``Register.php``, passando come paremetri username e pw ("name" e "password"). Se la richiesta va a buon fine verrà restituito un token importante perché mediante questo sarà possibile ordinare i panini e consultare la lista di panini ordinati.
- Accedere come utente precedentemente registrato invocando il file ``Login.php``, passando come paremetri username e pw ("name" e "password"). Se la richiesta va a buon fine verrà restituito il token relativo all'utente.
- Consultare i panini ordinati (lo storico degli ordini) e il saldo, relativi ad uno specifico utente invocando il file ``Orders.php`` e passando tramite GET o POST il token (es URL?token=1B#234). Se la richiesta andrà a buon fine verrà restituito appunto lo storico dei panini. Per l'esempio della risposta vedere il file ``Docs/orders.json``.
- Ordinare dei panini invocando il file ``Purchase.php`` e passando tramite **GET** il token relativo ad un utente già registrato e tramite **POST** la lista dei panini da ordinare che dovrà avere la formattazione indicata nel file ``Docs/dummy.json``. Se la richiesta andrà a buon fine verrà ritornato il saldo rimanente relativo all'utente.

## Cose importanti da sapere prima di usare l'API

1. A parte per il campo "token" del file ``Purchase.php`` che vuole la GET, in tutti gli altri file i parametri possono essere passati sia con GET che con POST.
2. Sia ``Register.php`` che ``Login.php`` rispondono con un token alla voce "token", mentre ``Purchase.php`` con il saldo alla voce "saldo".
3. Poiché il db è condiviso, mentre sviluppate la vostra meravigliosa app, sarebbe meglio se usaste sempre lo stesso utente per non riempire il db di spazzatura.
4. Ricordiamo che quando ricevete una risposta basta fare il decode e leggere i parametri, l'avete già fatto quando avete lavorato con le API, quindi evitiamo di disturbare chi lavora per ste robe grazie.
5. Il token è una **stringa**, es ``{"token":"g9876b#32à1"}``.
6. Se avete domande, pensateci bene perché magari la risposta è ovvia (basta usare questo 🧠) o è scritta qui.
7. La più **IMPORTANTE**: non rompete alla povera gente che già vi ha tirato su tutto il server e l'api, perché se ci disturbate vi mandiamo i pacchi bomba a casa.🥰

E ORA PROGRAMMATORE BUONO SVILUPPO DELLA TUA APPLICAZIONE DI BURGER SHOP!!! 🍔
