<!-- Alba Matamoros Morales -->
# Pràctica 05 - Social Authentication & Miscel·lània
Si vols fer proves amb usuaris ja creats tots tenen el pasword = P@ssw0rd

La temàtica de la meva pàgina és "Personatges de One piece", els usuaris han d'introduir tots els personatges existents actualment, cada usuari fa la seva aportació sense repetir l'usuari inserit per altra persona.

## Estructura
index.php ➜ Porta indexVista.php.

- **Controlador:**
    - controladorCanviContra.php ➜ Control d'errors i canvi de contrasenya.
    - controladorEsborrar.php ➜ Control d'errors i esborrar personatge.
    - controladorEsborrarIndex.php ➜ Controlador per quan volem esborrar un personatge a inici amb el botó de paperera.
    - controladorInsertar.php ➜ Control d'errors i insertar personatge.
    - controladorLogin.php ➜ Login d'usuaris.
    - controladorModificar.php ➜ Control d'errors, modificar personatge i agafar l'id del personatge exsistent.
    - controladorModificarDades.php ➜ Tractar el personatge de "controladorModificar.php" i modificar els valors agafant l'id.
    - controladorPaginacio.php ➜ Controlador amb 4 funcions, 2 per paginació global i 2 per usuari.
    - controladorPaginacioConsultarMenu.php ➜ Controlador per consultar els articles totals.
    - controladorRegistrar.php ➜ Registre usuari.
    - controladorTancarSessio.php ➜ Tractem el session per tancar sessió a l'usuari.

- **Models:**
    - connexio.php ➜ Funció amb la connexió a la bd.
    - modelPaginacio.php ➜ Model amb les funcions necesaries per la paginació.
    - modelPersonatges.php ➜ Model amb les funcions dels personatges.
    - modelUsuaris.php ➜ Model amb les funcions dels usuaris.

- ***Vistes:**
    - vistaCanviContra.php ➜ Vista per canviar la contrasenya.
    - vistaConsultar.php ➜ Vista per consultar tots els personatges globals.
    - vistaEsborrar.php ➜ Esborrar personatge.
    - vistaIndex.php ➜ Vista Inicial.
    - vistaInserir.php ➜ Inserir personatge.
    - vistaLogin.php ➜ Form per fer login.
    - vistaMenu.php ➜ Menú amb les opcions, (Inserir, Modificar, Esborras i consultar)
    - vistaModificar.php ➜ Vista amb un form que demana el nom d'un personatge a modificar.
    - vistaModificarDades.php ➜ Vista amb un form amb les dades del personatge triat per a modificar.
    - vistaRegistrarse.php ➜ Vista per registrar-se.

- **Estils:**
    - estilBarra.css ➜ Estils de la barra de navegació. 
    - estilError.css ➜ Estils dels errors.
    - estilPerfil.css ➜ Estils dels forms/iniciar sessió i registrar-se.
    - estilMenuPersonatges.css ➜ Estil del menú per seleccionar, (Inserir, Modificar, Esborrar...)
    - estilMostrar.css ➜ Estils per mostrar els personatges + paginació.
    - estilPersonatges.css ➜ Estils dels forms, (Inserir, Esborrar, Modificar...)
    - wallpaper.jpg ➜ Imatge fons de pantalla.


Per la meva part m'agradaria comentar que al final vaig decidir dividir d'aquesta forma el model per fer-lo més entenedor i que no hi hagués tant volum de dades en un mateix fitxer.

## Sessions i cookies
### $_SESSIONS
    Utilitzo sessions per agafar les dades de l'usuari que vol iniciar sessió. Un cop l'usuari inicia sessió modifiquem on pot accedir.

    En iniciar apareix Gestió de personatges i a perfil apliquem el seu nom d'usuari. A més, el desplegable es modifica mostren, Tancar Sessió i nova contrasenya.

    Les dades de l'usuari les recullo a controladorLogin.php, i les tracto en tots els fitxers necessaris (pràcticament tots).

### $_COOKIES
    Les cookies són utilitzades en la paginació per guardar la preferència de personatges mostrats per pantalla a l'hora de paginar.

    Aquestes són tractades en vistaIndex.php que és on utilitzem aquest from/selection i a controladorPaginacio.php.

    En el meu cas, he fet que la cookie sigui infinita perquè sempre es guardi la preferència.

## Funcionalitats
Aquí explicaré arxius que potser a primera vista no s'entenen que són:

    - controladorModificar.php
    - controladorModificarDades.php

    Aquests dos controladors van de la mà, controladorModificar busca l'usuari i passa l'id per GET i controladorModificarDades modifica qualsevol dada que entri nova l'usuari per modificar aquest.

    A més, controladorModificarDades també s'utilitza quan l'usuari prem la icona del llapis, ja que quan pressiona el botó redirigim a aquest controlador amb l'id del personatge.

    - controladorPaginacio.php
    - controladorPaginacioConsultarMenu.php

    Aquest dos controlador gestionen la paginació, controladorPaginacio controla tota la paginació d'inici i l'altre gestiona la paginació de l'apartat consultar.

    - controladorEsborrarIndex.php

    Aquest controlador és el que s'encarrega de gestionar els errors que poden succeir mentre intentem esborrar un personatge mitjançant la icona de la paperera.