<!-- Alba Matamoros Morales -->
# Pràctica 05 - Social Authentication & Miscel·lània
Si vols fer proves amb usuaris ja creats tots tenen el pasword = P@ssw0rd

ALGUNS USUARIS:

ppan -> P@ssw0rd
Admin, mjane -> P@ssw0rd
Admin, amatamoros -> P@ssw0rd

La temàtica de la meva pàgina és "Personatges de One piece", els usuaris han d'introduir tots els personatges existents actualment, cada usuari fa la seva aportació sense repetir l'usuari inserit per altra persona.

## Descripció del Projecte

Aquest projecte és una aplicació web que permet als usuaris autenticar-se utilitzant diferents mètodes socials i afegir personatges de la sèrie "One Piece". Cada usuari pot contribuir amb personatges, assegurant-se que no es repeteixin.

## Estructura

## Raíz
- **`controlador`**
  - `HybridAuthC`
    - `callbackReddit.php`
  - `OAuth`
    - `callbackGoogle.php`
  - `controladorAdministrarPerfil.php`
  - `controladorAfegirPersonatge.php`
  - `controladorAutenticacio.php`
  - `controladorBaixaUsuari.php`
  - `controladorEditarPerfil.php`
  - `controladorLlistarPersonatges.php`
  - `controladorLogout.php`
  - `controladorRegistrarUsuari.php`
  - `controladorVeurePerfil.php`
- **`estils`**
- **`lib`**
- **`model`**
- **`vista`**
  - **`errors`**
  - **`imatges`**
    - **`imatgesUsers`**
- **`inde.php`**
- **`.htaccess`**
- **`env.php`**
- **`.gitingore`**

