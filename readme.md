<img src="https://user-images.githubusercontent.com/77786971/140647238-5f1f4dcd-1fd6-4061-a927-907d1e99205e.png" alt="bc_logo" style="zoom:25%;" />

Alexandre Alleaume

Bryan Guillot 

Lucas Pisano																							BRANCODEURS

​																														Rapport

 

Le Projet-Vetux line devait prendre que 2 semaines, mais après quelques complications les professeurs nous ont accordés un délai supplémentaire (3 semaines). L’objectif est de créer une application permettant de fusionner des fichiers csv. L’utilisation du Framework symfony est demandée. Il faut que l’utilisateur puisse choisir entre un mélange séquentiel et entrelacé pour les fichiers csv.

En ce qui concerne la mise en place du projet, nous avons commencer par vérifier que nous ayons tous la même version de chaque outils que nous utiliserons (PHP, mariadb, xampp, phpStorm etc…). Puis nous avons créé un serveur discord pour pouvoir rapidement se transférer des données ou partager des Screenshots. Le serveur nous permet également de partager nos écrans en permanence aux autres.

 

Les premières étapes pour le projet étaient ces commandes pour la création des fichiers nécessaires (Framework) :

« composer install »

« composer create-project symfony/website-skeleton vetux »

« Composer require annotations »

 

Ensuite nous avons créé la base de données phpMyAdmin pour le projet. Pour cela nous avons réduit la taille des deux fichiers csv comme demandé. Nous obtenons donc deux tables.

![1](https://user-images.githubusercontent.com/77786971/139594151-87417e28-905d-4144-8997-b7cf073531ca.PNG)

Nous allons utiliser ces tables pour l’entièreté du projet. Si nous voulons utiliser les fichiers complets (2000 et 3000 lignes), il nous suffira d’augmenter la taille maximale de fichiers sur la DDB. Mais pour rendre les tests plus simples et compréhensifs, nous resterons avec les petits fichiers.



Nous avons trouvé un projet similaire en ligne et nous en sommes inspiré pour le projet form car cela nous semblait approprier.

 

Début du développement.

![2](https://user-images.githubusercontent.com/77786971/139594178-fcdd0ee6-69a4-4513-be7f-cbd1cf204129.PNG)

![3](https://user-images.githubusercontent.com/77786971/139594189-7576664e-cffe-4461-ba05-3b9510b541c6.PNG)

![4](https://user-images.githubusercontent.com/77786971/139594193-767da550-0cf3-48e9-91fa-ff9b1ba2ad2b.PNG)

Voici a quoi ressemble le formulaire après quelques problèmes qui ont pris pas mal de temps à régler. Il y avait tout d’abord un problème de droit sur les fichiers (besoin d’exécuter phpMyAdmin en mode administrateurs). Il y avait également un problème d’extension. Ce problème a mis un temps fou à se résoudre. Pour une raison qui nous échappe, l’extension fileinfo n’était pas reconnue alors qu’elle était activée dans php.ini. Cela nous a fait perdre énormément de temps car même les professeurs n’arrivaient pas à résoudre le problème. Finalement, ceux ayant le problème au sein du groupe ont continué de travailler sur une autre machine qui n’avait pas ce problème. (Le pc portable de Lucas.P a toujours ce problème).



Après cette perte de temp nous avons décidé de s'approprier le code découvert précédemment (Sparkline) en le modifiant à notre convenue afin qu'il réponde mieux aux attentes du projet.

 

Une fois que le groupe a enfin un projet qui fonctionne, nous avons modifier le formulaire. Ce dernier n'accepte que les extensions .csv.

![5](https://user-images.githubusercontent.com/77786971/139594209-85a243b2-e5b6-4f8f-84b3-d8c0a5fd7198.PNG)

![6](https://user-images.githubusercontent.com/77786971/139594221-ae08d5b2-ec03-40ab-86ce-1775e009d8b7.PNG)

Après quelques problèmes avec le bouton de déconnexion qui redirigeait l’utilisateur au localhost redirige maintenant à la page de login.

![7](https://user-images.githubusercontent.com/77786971/139594233-12a90c6f-44b5-45fb-9a63-65f64e5601a4.PNG)

![8](https://user-images.githubusercontent.com/77786971/139594245-4c0d99ab-5ab0-4d8f-8773-6c64e2fde0c9.PNG)

Voici le formulaire concernant les clients invalides, que ce soit pour la taille en cm ou inches, un code de carte de crédit invalide, ou encore l’âge du client (majeur ou non).

![9](https://user-images.githubusercontent.com/77786971/139594253-03efd5f9-2d2c-4dbb-8506-476fc325e24a.PNG)

![10](https://user-images.githubusercontent.com/77786971/139594264-67df9e51-be00-4149-bfa9-86c39c059432.PNG)

L’utilisateur peut donc sélectionner ce qu’il veut et obtenir un fichiers csv filtré.



**Test**



Pour tester le bon fonctionnement de nos classes nous utilisons un dossier de test contenant VerificationTestphp. et csvTest.php.

Voici à quoi ressemble le premier Test unitaire:



-csvTest.php

![test1](https://user-images.githubusercontent.com/77786971/140065197-9b1bb5d6-f9c5-498a-8262-11cac4248347.png)

![test2](https://user-images.githubusercontent.com/77786971/140065732-39a3b0c8-a7c1-44cf-b4c1-45a1f9554088.png)

Voici le resultat de ce test unitaire:

![test3](https://user-images.githubusercontent.com/77786971/140065363-c178ae75-ac2d-4aa0-8050-3eb74cc90cdf.png)

 

-VerificationTest.php

![test4](https://user-images.githubusercontent.com/77786971/140065583-b99262df-9203-47b6-a920-53662ff03a05.png)

et voici le resultat du test unitaire ci-dessus:

![test5](https://user-images.githubusercontent.com/77786971/140065948-8a41befc-3204-4a34-8e95-8b3cbba89f3b.png)



Concernant la partie ETL nous avons trois tables customers, vehicules et mark.



Entité customers:

![customer](https://user-images.githubusercontent.com/77786971/140066650-1a09e077-45d4-4d0f-82d7-6e259cff5708.png)



Entité Vehicule:

![vehicule](https://user-images.githubusercontent.com/77786971/140066782-077f65bd-0283-4797-8105-18b2e086e8e1.png)



Entité mark:

![mark](https://user-images.githubusercontent.com/77786971/140066918-a0e8375b-2301-4ad0-a7b7-0721348f5e1a.png)



on peut ajouter des utilisateurs avec ce formulaire :

![ajout utilisateur](https://user-images.githubusercontent.com/77786971/140067408-f163dba2-4e40-4b4b-98f2-62af9e2b44c8.png)

voici a quoi ressemble le tableau pour visualiser les données de l'utilisateur ajouté:

![user data](https://user-images.githubusercontent.com/77786971/140067709-99ad0143-1964-412a-879d-40649135ef95.png)





Evil user story

 

Pour assurer que n’importe quel utilisateur ne puisse avoir un accès administrateur sur Vetux Line, nous utilisons : use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface; 

![11](https://user-images.githubusercontent.com/77786971/139594279-e066729b-2953-4904-a478-8153bb4b2a5c.PNG)

Ce qui a pour but d’encoder le mot de passe.

 

De plus, pour contrer la navigation par url (manipuler l’url pour accéder a des pages admin par exemple) n’est pas possible dans ce projet. C’est le cas ici car uniquement l’utilisateur auteur de ce projet possède les droits pour l’application. Cet utilisateur a été créé en même temps que la base.

![12](https://user-images.githubusercontent.com/77786971/139594290-071ca42d-4cea-433b-8957-913a0b71406c.PNG)

Après un peu de css voici à quoi ressemble l’application

Nous pouvons maintenant ajouter des clients, visualiser les données avec un tableau et le css est complet.

 

Login

![13](https://user-images.githubusercontent.com/77786971/139594309-81ff69af-f000-4919-9228-498398a3568c.PNG)

App

![14](https://user-images.githubusercontent.com/77786971/139594316-e02e726f-f3f2-412f-ba0e-853876a6d0d8.PNG)

![15](https://user-images.githubusercontent.com/77786971/139594326-ab18a645-c132-4b40-aa1f-96aeafbcc37c.PNG)

![16](https://user-images.githubusercontent.com/77786971/139594339-40d90fbe-989a-42f2-ac04-7f3a2776f041.PNG)

![17](https://user-images.githubusercontent.com/77786971/139594346-59acc5d2-853e-48a4-8181-4092666ceb4f.PNG)



Ensuite nous avons sécuriser la sélection de fichiers, on peut désormais sélectionner uniquement les fichiers csv ce qui empêchent l'utilisateur injecté un script malveillant, voici le code de cette sécurité ci-dessous:

![securité csv](https://user-images.githubusercontent.com/77786971/140646545-6e141362-c9fe-4c9c-9d7b-84d6b692d966.png)



Enfin pour évité que l'utilisateur n'utilise le compte pour accéder a d'autre base de données, ce dernier à été crée uniquement pour cette base de données:

![utilisateur admin](https://user-images.githubusercontent.com/77786971/140647016-f16bdd7b-8fec-411b-b757-3dc999501aeb.png)



Sources :

https://symfony.com/doc/current/index.html

https://twig.symfony.com/doc/3.x/

https://developer.mozilla.org/fr/docs/Web/JavaScript

https://stackoverflow.com/questions/7977084/check-file-type-when-form-submit

https://stackoverflow.com/questions/1860490/interleaving-multiple-arrays-into-a-single-array

https://openclassrooms.com/forum/sujet/erreur-sqlstate-hy000-1044

https://stackoverflow.com/questions/29986626/pdoexception-1044-sqlstatehy000-1044-access-denied-for-user-localhost

https://csv.thephpleague.com/

https://www.apachefriends.org/docs/

https://www.phpmyadmin.net/docs/
