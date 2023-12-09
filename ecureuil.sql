-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 11 nov. 2023 à 14:12
-- Version du serveur :  5.7.31
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `efficiency`
--

-- --------------------------------------------------------

--
-- Structure de la table `bans`
--

DROP TABLE IF EXISTS `bans`;
CREATE TABLE IF NOT EXISTS `bans` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user` int(10) NOT NULL,
  `msg` varchar(255) NOT NULL,
  `date` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  PRIMARY KEY (`id`),
  KEY `user` (`user`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `bans`
--

INSERT INTO `bans` (`id`, `user`, `msg`, `date`) VALUES
(1, 14, 'ban', '2023-11-10 08:06:11.426224');

-- --------------------------------------------------------

--
-- Structure de la table `cardlikes`
--

DROP TABLE IF EXISTS `cardlikes`;
CREATE TABLE IF NOT EXISTS `cardlikes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user` int(10) NOT NULL,
  `card` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `card` (`card`),
  KEY `user` (`user`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `cardlikes`
--

INSERT INTO `cardlikes` (`id`, `user`, `card`) VALUES
(20, 2, 7),
(21, 2, 20),
(22, 2, 21),
(23, 2, 11),
(24, 2, 12),
(25, 2, 7),
(26, 2, 7),
(27, 2, 7),
(28, 2, 20),
(29, 2, 7),
(30, 2, 7),
(31, 2, 7),
(32, 2, 7),
(33, 2, 20),
(34, 2, 20),
(35, 2, 20),
(36, 2, 20),
(37, 2, 21),
(38, 14, 11),
(39, 14, 12),
(40, 3, 7),
(41, 8, 21),
(42, 6, 11),
(43, 10, 21),
(44, 13, 21),
(45, 3, 20);

-- --------------------------------------------------------

--
-- Structure de la table `cards`
--

DROP TABLE IF EXISTS `cards`;
CREATE TABLE IF NOT EXISTS `cards` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `contentText` longtext NOT NULL,
  `gitHub` longtext,
  `status` varchar(255) NOT NULL DEFAULT 'toVerify',
  `createdDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `summary` varchar(1000) NOT NULL,
  `user` int(10) NOT NULL,
  `thematic` int(10) NOT NULL,
  `platform` int(10) NOT NULL,
  `img` varchar(255) DEFAULT 'NULL',
  PRIMARY KEY (`id`),
  KEY `platform` (`platform`),
  KEY `thematic` (`thematic`),
  KEY `user` (`user`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `cards`
--

INSERT INTO `cards` (`id`, `title`, `contentText`, `gitHub`, `status`, `createdDate`, `updatedDate`, `summary`, `user`, `thematic`, `platform`, `img`) VALUES
(7, 'Comment supprimer le fond de plusieurs images sur Photoshop ?', '<p>batch-bg-remover-photoshop</p><p>Il y a une nouvelle fonctionnalité depuis Adobe Photoshop 2020 CC pour sélectionner le sujet d\'une image. Ce script simple utilise cet outil pour supprimer l\'arrière-plan de toutes les images dans un dossier spécifié.</p><p>Voici la vidéo détaillée sur la façon d\'utiliser ce script : https://youtu.be/6ICVsi2pWyk</p><p>Définir le dossier des images source : ligne 13</p><p>Définir le dossier de sortie : ligne 15</p><p>Définir le remplissage ou rendre transparent l\'arrière-plan : ligne 22</p><p>Définir la couleur de remplissage de l\'arrière-plan : lignes 18 à 20 (entrer les valeurs RGB de 0 à 255)<br>Nouvelles fonctionnalités</p><p>Ajout de la prise en charge de l\'utilisation d\'une image prédéfinie comme arrière-plan. Changez la variable à la ligne 25 en true. Ensuite, ouvrez l\'image que vous souhaitez conserver en arrière-plan. Enfin, exécutez le script de la même manière.</p>', '/*------------------------------------------------------------------------------------ Configure following paramers before running the script --------------------------------------------------------------------------------------*/ //Place all images needs to be processed in a folder. Add the path below. var sourceFolder = Folder(\"C:\\\\ps\\\\src\"); //Add the path of an existing folder below to save the output. var saveFolder = new Folder(\"C:\\\\ps\\\\out\"); //Fill color of the background var colorRef = new SolidColor; colorRef.rgb.red = 255; colorRef.rgb.green = 255; colorRef.rgb.blue = 255; //Set blow to true to make the background transparent. var isTransparent = true; //Set below to true to use an image as background var isImageBg = true; //If isImageBg is set to true, //it\'s required to the background image to be preopened in photohsop //Backdound image must be the active document //-----------------------------------------------------------------------------------   //Check if it\'s selected to use an image as background 	if(isImageBg){ 		//Store background image and a variable 		var doc_bg = app.activeDocument; 	}   //Cheks if the source folder is null   if (sourceFolder != null)   { 	//The following line will list all files (not only image files) on the source folder. 	//If you have any non-image files (even hidden) , please see the next comment.     	//var fileList = sourceFolder.getFiles(); 	//Comment the above line and uncomment the following line to filter specific file types. 	//Try filter files types if the script fails. 	var fileList = sourceFolder.getFiles(/\\.(jpg|jpeg|png|tif|psd|crw|cr2|nef|dcr|dc2|raw|heic)$/i);   }   else{ 	  alert(\"No images found on source folder\");   }   //Now this will open every file in the file list for(var a = 0 ;a < fileList.length; a++){ 	//Open file in photoshop     	app.open(fileList[a]);  	// Select subject 	var idautoCutout = stringIDToTypeID( \"autoCutout\" ); 	var desc01 = new ActionDescriptor(); 	var idsampleAllLayers = stringIDToTypeID( \"sampleAllLayers\" ); 	desc01.putBoolean( idsampleAllLayers, false ); 	try{ 		executeAction( idautoCutout, desc01, DialogModes.NO ); 	} 	catch(err){} 	// Invert the selection 	app.activeDocument.selection.invert();   	//Now the background is selected. Next step is to fill or clear the selection. 	if(isTransparent){ 		//Make active layer a normal layer. 		activeDocument.activeLayer.isBackgroundLayer = false; 		//Make the selection transparent 		app.activeDocument.selection.clear(); 	} 	else{ 		app.activeDocument.selection.fill(colorRef); 	} 	 	 	//Check if it\'s selected to use an image as background 	if(isImageBg){ 		//Store main document to a variable 		var main_doc = app.activeDocument; 		//Swich to background image 		app.activeDocument = doc_bg; 		//Copy background to the main image 		app.activeDocument.activeLayer.duplicate(main_doc, ElementPlacement.PLACEATEND); 		//Switch to the main image 		app.activeDocument = main_doc; 	} 	  	//Now the image is proccessed. Next step is saving the image. 	//Create the file name 	var fileName = app.activeDocument.name.replace(/\\.[^\\.]+$/, \'\');  	pngSaveOptions = new PNGSaveOptions(); 	//Edit png options here. 	//Save image as PNG 	app.activeDocument.saveAs(new File(saveFolder +\'/\'+ Date.now() + \"_\" + fileName + \'.png\'), pngSaveOptions, true, Extension.LOWERCASE); 	//Close image whithout saving as PSD 	app.activeDocument.close(SaveOptions.DONOTSAVECHANGES); } PROBLEME CORRIGE', 'verify', '2023-11-09 22:11:47', '2023-11-09 22:11:47', 'Comment supprimer le fond de plusieurs images sur Photoshop ?', 14, 7, 1, 'NULL'),
(9, 'Automatisation Linkedin : Comment le faire ?', '', '', 'verify', '2023-11-09 22:42:15', '2023-11-09 22:42:15', 'Automatisation Linkedin : Comment le faire ?', 7, 9, 3, 'NULL'),
(10, 'Créer une automatisation dans Raccourcis sur iPhone ou iPad', '', '', 'verify', '2023-11-09 22:43:39', '2023-11-09 22:43:39', 'Créer une automatisation dans Raccourcis sur iPhone ou iPad', 9, 2, 5, 'NULL'),
(11, 'Comment extraire les données clients de WooCommerce vers WordPress', 'Comment extraire les données clients de WooCommerce vers WordPress\r\n\r\nWooCommerce est une extension de WordPress qui permet de créer une boutique en ligne. Elle fournit une API qui permet d\'accéder aux données des clients et des commandes. Ce script Python permet d\'utiliser l\'API WooCommerce pour extraire les données clients vers un fichier CSV.\r\n\r\nLe script commence par importer les modules nécessaires, notamment le module woocommerce qui fournit une interface à l\'API WooCommerce. Ensuite, il crée une instance de l\'API WooCommerce en spécifiant l\'URL de la boutique WooCommerce, les clés API et la version de l\'API.\r\n\r\nLa fonction script() est ensuite définie. Cette fonction ouvre un fichier CSV en écriture et crée un objet csv.writer pour écrire les données dans le fichier. Ensuite, elle définit les paramètres de pagination pour limiter la quantité de données récupérées.\r\n\r\nLa fonction utilise ensuite une boucle while pour parcourir tous les utilisateurs de la boutique. Pour chaque utilisateur, la fonction récupère les commandes de l\'utilisateur. Pour chaque commande, la fonction récupère les informations suivantes :\r\n\r\nL\'ID de la commande\r\nLa liste des produits commandés\r\nLa quantité de chaque produit commandé\r\nLe prix total de la commande\r\nLa fonction combine ensuite ces informations dans un tableau et l\'écrit dans le fichier CSV.\r\n\r\nEnfin, la fonction if name == \"main\": est utilisée pour exécuter la fonction script() si le script est exécuté directement.\r\n\r\nVoici un exemple de fichier CSV généré par le script :\r\n\r\nID User,Nom,Prénom,Email,Ville,Pays,Code Postal,ID Commande,Produits,Quantité,Prix total\r\n1,Dupont,Jean,jean.dupont@example.com,Paris,France,75001,1,T-shirt blanc,1,25,00 €\r\n2,Martin,Marie,marie.martin@example.com,Lyon,France,69001,2,Pantalon noir,2,50,00 €\r\nUne fois que vous avez extrait les données clients vers un fichier CSV, vous pouvez les importer dans WordPress ou dans un autre système.', '# Importer les modules nécessaires\r\nimport woocommerce from woocommerce import API\r\nimport csv\r\n\r\n# Créer une instance de l\'API WooCommerce\r\nwcapi = API(\r\n    url=\"url_du_site\",\r\n    consumer_key=\"consumer_key\",\r\n    consumer_secret=\"consumer_secret\",\r\n    wp_api=True,\r\n    version=\"wc/v3\"\r\n)\r\n\r\n# Définir une fonction pour extraire les données clients\r\ndef script():\r\n    # Ouvrir un fichier CSV en écriture\r\n    with open(\'mineral-blue-orders.csv\', \'w\', newline=\'\') as csvfile:\r\n        # Créer un objet writer CSV\r\n        csv_writer = csv.writer(csvfile)\r\n\r\n        # Écrire l\'en-tête du CSV\r\n        csv_writer.writerow(\r\n            [\'ID User\', \'Nom\', \'Prénom\', \'Email\', \'Ville\',\'Pays\', \'Code Postal\', \'ID Commande\', \'Produits\', \'Quantité\',\r\n             \'Prix total\'])\r\n\r\n        # Paramètres de pagination\r\n        page = 1\r\n        per_page = 100  # Ajuste cela selon tes besoins\r\n\r\n        # Boucle pour récupérer tous les utilisateurs\r\n        while True:\r\n            # Obtenir la liste des utilisateurs pour la page actuelle\r\n            customers = wcapi.get(f\"customers?per_page={per_page}&page={page}\").json()\r\n\r\n            # Sortir de la boucle si aucun utilisateur n\'est retourné\r\n            if not customers:\r\n                break\r\n\r\n            # Parcourir les utilisateurs de la page actuelle\r\n            for customer in customers:\r\n                customer_id = customer[\'id\']\r\n                customer_first_name = customer[\'first_name\']\r\n                customer_last_name = customer[\'last_name\']\r\n                customer_email = customer[\'email\']\r\n\r\n                # Obtenir les commandes de l\'utilisateur\r\n                user_orders = wcapi.get(f\"orders?customer={customer_id}\").json()\r\n\r\n                # Parcourir les commandes de l\'utilisateur\r\n                for order in user_orders:\r\n                    order_id = order[\'id\']\r\n                    products = \', \'.join([item[\'name\'] for item in order[\'line_items\']])\r\n                    quantity = sum([item[\'quantity\'] for item in order[\'line_items\']])\r\n                    total_price = order[\'total\']\r\n\r\n                    shipping_city = order[\'shipping\'][\'city\']\r\n                    shipping_country = order[\'shipping\'][\'country\']\r\n                    shipping_postcode = order[\'shipping\'][\'postcode\']\r\n\r\n                    row_data = [customer_id, customer_first_name, customer_last_name, customer_email, shipping_city,\r\n                                shipping_country, shipping_postcode, order_id, products, quantity, total_price]\r\n\r\n                    csv_writer.writerow(row_data)\r\n            page += 1\r\n\r\n# Exécuter le script\r\nif __name__ == \'__main__\':\r\n    script()', 'verify', '2023-11-09 22:46:26', '2023-11-09 22:46:26', 'Comment extraire les données clients de WooCommerce vers WordPress', 5, 4, 4, 'NULL'),
(12, 'Comment gérer vos fichiers avec Photoshop ?', '', '', 'verify', '2023-11-09 22:46:59', '2023-11-09 22:46:59', 'Gestion de fichiers avec Photoshop', 13, 1, 1, 'NULL'),
(13, 'Comment automatiser le traitement de texte sur Linkedin ?', '', '', 'verify', '2023-11-09 22:48:33', '2023-11-09 22:48:33', 'Comment automatiser le traitement de texte sur Linkedin ?', 7, 3, 3, 'NULL'),
(14, 'Comment simplifier l\'administration système avec Apple Shortcut ?', '', '', 'verify', '2023-11-09 22:48:51', '2023-11-09 22:48:51', 'Comment simplifier l\'administration système avec Apple Shortcut ?', 10, 5, 5, 'NULL'),
(15, 'Comment automatiser la gestion des réseaux sociaux ?', '', '', 'verify', '2023-11-09 22:49:20', '2023-11-09 22:49:20', 'Comment automatiser la gestion des réseaux sociaux avec Wordpress ?', 14, 9, 4, 'NULL'),
(17, 'Comment manipuler des médias automatiquement sur Premiere Pro ?', '', '', 'verify', '2023-11-09 22:51:47', '2023-11-09 22:51:47', 'Comment manipuler des médias automatiquement sur Premiere Pro ?', 7, 7, 2, 'NULL'),
(18, 'Édition d\'images avec Photoshop : Astuces clés.', '', '', 'toVerify', '2023-11-09 23:08:40', '2023-11-09 23:08:40', 'Édition d\'images avec Photoshop : Astuces clés.', 2, 7, 1, 'NULL'),
(19, 'Productivité améliorée avec Premiere Pro', '', '', 'toVerify', '2023-11-09 23:09:07', '2023-11-09 23:09:07', 'Productivité améliorée avec Premiere Pro', 2, 2, 2, 'NULL'),
(20, 'Automatisation Linkedin : Comment faire ?', '<p>LinkedIn est LE réseau social incontournable de ces dernières années. Il ne s’agit plus de voguer à l’inconnu sur le réseau, ou même d’en faire votre CV numérique, non ici une stratégie de contenu ou de prospection seront inévitables pour faire de LinkedIn un levier pour votre Business.</p><p>Ici, je vais vous expliquer comment vous pourrez automatiser vos actions marketing sur LinkedIn.</p><p>On ne traitra pas trop du “Pourquoi” ici, mais si vous voulez en commentaire me donner vos opinions à ce sujet, ce sera avec plaisir que je vous lirai et que j’y répondrai.</p><p>Pour faire deux lignes sur ce sujet, je dirai que LinkedIn est un réseau social qui, depuis longtemps maintenant, n’est plus destiné à être votre “CV numérique”.</p><p>Une présence et surtout, une activité sur ce réseau vous permettront de créer ce réseau si important dans le lancement de projet, de créer ces liens faibles que vous activerez pendant votre campagne, qui se transformeront en liens forts par la contribution pour financer votre projet. C\'est par votre capacité de faire ensemble et d\'avoir une démarche d\'entrepreneur, que vous réussirez à \"booster\" votre campagne.</p><p>Une stratégie de contenu, une stratégie de prospection sont indéniablement nécessaires pour percer sur ce réseau et en tirer le maximum de bénéfices.</p><p>En clair, que ce soit pour prospecter, augmenter votre visibilité, LinkedIn c’est un grand OUI.&nbsp;</p><p>Voilà pourquoi, vous devez déjà être et être actif sur ce réseau.</p><p><img src=\"https://lh7-us.googleusercontent.com/163foKnounvmAfTHG--CBuyiWcVo0K92Va5_l52WsHkjelnXtqmCtWy3k9wn1cDNhW1ehuuiNEiOWb3bxS63WaInnmysU12R_wYVXVgAmJsK1J9mDTNoSq4dHNUPsgQ4n1Z-3T8Moed0gkc6Ajb9qjQ\" alt=\"No alt text provided for this image\" width=\"602\" height=\"317\"></p><p>Créer des liens et renforcer ceux existant est déterminant pour réussir.</p><h2><strong>Ca veut dire quoi “Automatiser” ?</strong></h2><p>Il est toujours important de rappeler les bases.</p><p>Automatiser, cela veut simplement dire que vous allez avoir recours à des outils pour automatiser une certaine partie de vos tâches, souvent chronophages.</p><p>Pour les fans de dictionnaire et de définition formelle, voici ce qu’on nous dit : “Exécution totale ou partielle de tâches techniques par des machines fonctionnant sans intervention humaine.”</p><p>Le bénéfice est généralement le gain de temps. De ça, découle le fait que vous allez pouvoir concentrer votre temps sur des tâches plus stratégiques, plus importantes.</p><h2><strong>Que va t-on pouvoir automatiser ?</strong></h2><p>Sur LinkedIn, il est possible d’automatiser un certain nombre de tâches :</p><ul><li>Visiter des profils LinkedIn,</li><li>Envoyer des demandes de connexions,</li><li>Envoyer des messages,</li><li>Suivre des profils LinkedIn,</li><li>Accepter des demandes de connexion,</li><li>Envoyer des messages automatiques dès acceptation de la demande de connexion,</li><li>Scrapper les données de nos relations comme le n° de téléphone, l’email et toutes les données disponibles sur le profil LinkedIn,</li><li>Liker, commenter, réagir à des publications LinkedIn,</li><li>Mettre en place des campagnes d’actions automatisées.</li></ul><h3><strong>Pour la prospection:</strong></h3><p>Pour Monumentales ou la prospection pour la vente de mon livre, c\'est très efficace et cela permet de rencontrer en contact avec mon marché et de me concentrer sur la valeur que je souhaite apporter.</p><p>Vous êtes un commercial, un sales, un freelance, une start-up, vous cherchez à vendre votre solution, ou votre produit à des prospects et conclure des deals pour votre Business.Vous pouvez donc ici consacrer 30 minutes seulement d’hyper concentration sur les messages et relances que vous enverrez, car ce sont ces messages qui vous feront décrocher un call ou un intérêt de l’autre côté.</p><p>Vous lancez votre campagne d’actions et vous n’avez plus qu’à attendre les résultats et faire le suivi des réponses, en gros vous pourrez vous concentrer uniquement sur les prospects qui répondent, les prospects “chauds”.</p><h3><strong>Pour le contenu:</strong></h3><p>LinkedIn est devenu depuis quelques années et surtout récemment, un réseau de contenus, de médias.</p><p>Des personnes sont là pour créer de l’audience via du contenu, en renforçant leur image de marque. Vous gagnez en crédibilité, en légitimité et donc forcément vous pourrez devenir une référence sur votre marché.</p><p>En gros, une personne accro à vos contenus, pensera plus facilement à vous si il a un besoin que quelqu’un d’autre.</p><p>Un outil d’automatisation peut ici, vous permettre de programmer vos publications LinkedIn, suivre les KPIs par exemple.</p><p>Vous pouvez aussi automatiser l’envoi d’un formulaire d’inscription à un évènement à toutes les personnes qui commentent votre publication X sur LinkedIn. Il existe d’autres exemples.</p><p>L’utilisation d’un outil d’automatisation pour ce type de besoin peut être très intéressant.&nbsp;</p><h2><a href=\"https://www.waalaxy.com/?o=abtqpgjgdzmk\"><strong>Waalawy</strong></a><strong>, l\'outil que j\'utilise</strong></h2><h3><strong>Qu\'est-ce que c\'est Waalaxy ?</strong></h3><p>Waalaxy est un outil de prospection commerciale automatisée sur LinkedIn et par email. Il permet aux entreprises de gagner du temps et d\'améliorer l\'efficacité de leur prospection en automatisant les tâches répétitives, telles que l\'envoi d\'invitations, de messages et de relances.</p><p>Waalaxy propose une série de fonctionnalités qui permettent de cibler les prospects, de personnaliser les messages et de suivre les résultats de la prospection. Parmi ces fonctionnalités, on trouve :</p><ul><li>La recherche de prospects : Waalaxy permet de rechercher des prospects en fonction de critères tels que leur secteur d\'activité, leur fonction, leur localisation, etc.</li><li>L\'envoi d\'invitations : Waalaxy permet d\'envoyer des invitations à des prospects de manière automatisée.</li><li>L\'envoi de messages : Waalaxy permet d\'envoyer des messages à des prospects de manière automatisée.</li><li>La gestion des relances : Waalaxy permet de programmer des relances automatiques pour les prospects qui n\'ont pas répondu aux premières sollicitations.</li><li>Le suivi des résultats : Waalaxy permet de suivre les résultats de la prospection, tels que le nombre d\'invitations envoyées, le nombre de messages ouverts, le nombre de réponses, etc.</li></ul><p>Waalaxy est un outil payant, mais il propose une version gratuite qui permet de tester ses fonctionnalités.</p><p>Voici quelques exemples de cas d\'utilisation de Waalaxy :</p><ul><li>Une entreprise qui souhaite augmenter le nombre de leads qualifiés sur LinkedIn</li><li>Une entreprise qui souhaite gagner du temps sur la prospection commerciale</li><li>Une entreprise qui souhaite améliorer l\'efficacité de sa prospection</li></ul><p>Waalaxy est un outil puissant qui peut aider les entreprises à améliorer leur prospection commerciale. Il est particulièrement adapté aux entreprises qui souhaitent gagner du temps et améliorer l\'efficacité de leur prospection.</p><h2><strong>En quelques lignes</strong></h2><p>Vous l\'avez compris, Waalaxy vous permet d\'automatiser votre prospection sur Linkedin, en plus cet outil est gratuit avec une limite hebdomadaire de 100 invitations par semaine. L\'automatisation des campagnes multicanal est rendu simple et accessible. Le support est toujours la pour vous accompagner si besoin.</p><p>Je vous invite à utiliser mon lien d\'affiliation et vous bénéficierez de 2 mois de période d\'essai.</p><p>Alors n\'hésitez plus et vous n\'aurez plus besoin de commercial.</p>', '', 'verify', '2023-11-11 13:13:42', '2023-11-11 13:13:42', 'Automatisation Linkedin : Comment faire ?', 7, 9, 3, 'NULL'),
(21, 'Créer une automatisation personnelle dans Raccourcis sur iPhone ou iPad', '<p>Une automatisation personnelle est similaire à un raccourci. Cependant, elle est déclenchée par un événement et non manuellement.</p><h2>Créer une automatisation personnelle</h2><ol><li>Dans l’app Raccourcis sur votre appareil iOS ou iPadOS, effectuez l’une des opérations suivantes :<ul><li><i>S’il s’agit de votre première automatisation :</i> Touchez Automatisation .</li><li><i>Si vous avez déjà créé une automatisation :</i> Touchez Automatisation , puis touchez dans le coin supérieur droit</li></ul></li><li>Touchez « Créer une automatisation personnelle ».</li><li>Choisissez un déclencheur, tel que « Heure de la journée » ou « Arrivée ».<br>Consultez la rubrique&nbsp;<a href=\"https://support.apple.com/fr-fr/guide/shortcuts/apd932ff833f/7.0/ios/17.0\">Déclencheurs d’évènements</a>,&nbsp;<a href=\"https://support.apple.com/fr-fr/guide/shortcuts/apd8ebfc4e8e/7.0/ios/17.0\">Déclencheurs pour le voyage</a>,&nbsp;<a href=\"https://support.apple.com/fr-fr/guide/shortcuts/apdd711f9dff/7.0/ios/17.0\">Déclencheurs de communication</a> ou&nbsp;<a href=\"https://support.apple.com/fr-fr/guide/shortcuts/apde31e9638b/7.0/ios/17.0\">Déclencheurs de configuration</a>.</li><li>Sélectionnez les options pour le déclencheur, puis touchez Suivant.<br>Des options sʼaffichent pour la création dʼune automatisation vide, dʼune automatisation suggérée ou lʼutilisation dʼun raccourci existant.</li><li>Touchez « Ajouter une action », puis parcourez les actions disponibles dans la liste Catégories ou Apps, ou recherchez une action spécifique en touchant et saisissez un terme de recherche.</li><li>Pour ajouter une action à votre automatisation, touchez une action dans la liste et maintenez le doigt dessus, puis faites-la glisser vers la position où vous souhaitez qu’elle se trouve dans l’éditeur d’automatisation.<br>Vous pouvez également toucher une action pour l’ajouter en bas de la liste d’actions dans l’éditeur d’automatisation.</li><li>Ajoutez autant d’actions qu’il vous en faut pour votre automatisation.<br>Touchez en haut du navigateur d’actions pour retourner dans la liste Catégories ou Apps.<br><strong>Astuce :&nbsp;</strong>vous pouvez modifier l’ordre des actions en les faisant glisser vers d’autres emplacements dans l’éditeur de raccourci.</li><li>Pour tester votre automatisation, touchez .<br>Pour arrêter l’automatisation, touchez .</li><li>Touchez Suivant.<br>Un résumé de votre automatisation s’affiche.</li><li>Touchez OK.<br>La nouvelle automatisation est ajoutée à l’écran Automatisation.</li></ol>', '', 'toVerify', '2023-11-11 13:19:46', '2023-11-11 13:19:46', 'Créer une automatisation personnelle dans Raccourcis sur iPhone ou iPad', 9, 2, 5, 'NULL');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `content` varchar(1000) NOT NULL,
  `createdDate` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `user` int(10) NOT NULL,
  `card` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `card` (`card`),
  KEY `user` (`user`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `content`, `createdDate`, `user`, `card`) VALUES
(9, 'L\'article pour Photoshop est une ressource précieuse. Il simplifie la tâche de suppression d\'arrière-plan pour plusieurs images dans un dossier spécifique.', '2023-10-26 11:32:58.237676', 12, 7),
(10, 'C\'est un outil incontournable pour tous les utilisateurs de Photoshop.', '2023-11-07 16:33:16.748354', 9, 7),
(11, 'Wow ! Merci !', '2023-11-02 05:45:39.159750', 13, 7),
(15, 'Absolument d\'accord avec l\'idée que LinkedIn a évolué bien au-delà du simple CV numérique. C\'est devenu un terrain propice pour développer des opportunités d\'affaires. J\'apprécie votre approche axée sur l\'automatisation des actions marketing, car cela permet de maximiser l\'efficacité. Partagez-vous des outils spécifiques pour automatiser ces processus?', '2023-11-02 19:25:52.635586', 12, 20),
(16, 'Votre analyse sur l\'importance d\'une stratégie de contenu et de prospection sur LinkedIn est pertinente. Il est indéniable que le réseau offre des possibilités uniques pour établir des liens professionnels solides. J\'aimerais en savoir plus sur les tactiques spécifiques que vous recommandez pour créer du contenu engageant et optimiser sa visibilité. Des conseils concrets seraient très appréciés!', '2023-11-09 17:04:03.670036', 8, 20),
(17, 'Fascinant de voir comment LinkedIn a évolué au fil des années, passant d\'un simple CV numérique à un véritable levier stratégique pour les entreprises. Votre insistance sur la nécessité d\'une présence active et d\'une approche entrepreneuriale est très inspirante. Avez-vous des exemples de campagnes réussies qui ont utilisé ces stratégies de contenu et de prospection sur LinkedIn? J\'adorerais en apprendre davantage à partir d\'études de cas concrets', '2023-11-08 08:39:13.533517', 11, 20),
(18, 'Une solution pratique pour extraire les données clients de WooCommerce vers WordPress. Merci pour le partage de ce script Python efficace!', '2023-11-11 13:28:39.949749', 9, 11),
(19, 'Intéressant ! J\'apprécie la clarté du script Python pour accéder à l\'API WooCommerce. Extraction de données simplifiée, bien joué!', '2023-11-09 07:21:49.578245', 6, 11),
(20, 'La fonctionnalité de pagination pour gérer de grandes quantités de données est astucieuse. Un moyen efficace d\'extraire les informations nécessaires des utilisateurs de la boutique.', '2023-11-07 13:40:57.558113', 12, 11),
(21, 'J\'aime la simplicité de ce script et la façon dont il organise les données dans un fichier CSV. Une solution pratique pour l\'importation ultérieure dans WordPress.', '2023-11-06 09:00:07.958241', 9, 11);

-- --------------------------------------------------------

--
-- Structure de la table `commentsforums`
--

DROP TABLE IF EXISTS `commentsforums`;
CREATE TABLE IF NOT EXISTS `commentsforums` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `content` varchar(1000) NOT NULL,
  `createdDate` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `post` int(10) NOT NULL,
  `user` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post` (`post`),
  KEY `user` (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `contentmedia`
--

DROP TABLE IF EXISTS `contentmedia`;
CREATE TABLE IF NOT EXISTS `contentmedia` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `media` varchar(255) NOT NULL,
  `alt` varchar(255) NOT NULL,
  `card` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `card` (`card`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `favorites`
--

DROP TABLE IF EXISTS `favorites`;
CREATE TABLE IF NOT EXISTS `favorites` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user` int(10) NOT NULL,
  `card` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`user`),
  KEY `card` (`card`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(255) NOT NULL DEFAULT 'toVerify',
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `message` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `status`, `email`, `name`, `message`) VALUES
(1, 'verify', 'Pinel Fabien', 'fabien.pinel08@gmail.com', 'Je suis un message'),
(2, 'verify', 'Pinel Fabien', 'fabien.pinel08@gmail.com', 'Je suis un message'),
(3, 'toVerify', 'john.doe@email.com', 'John Doe', 'Bonjour, je suis John Doe, et je suis ravi de rejoindre votre site dautomatisation de scripts. Jai hâte de partager des astuces et des scripts utiles avec la communauté.'),
(4, 'toVerify', 'eva.smith@email.com', 'Eva Smith', 'Bonjour, je suis Eva Smith, une développeuse passionnée par lautomatisation des tâches répétitives. Cest un plaisir de faire partie de cette communauté.');

-- --------------------------------------------------------

--
-- Structure de la table `platforms`
--

DROP TABLE IF EXISTS `platforms`;
CREATE TABLE IF NOT EXISTS `platforms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `link` varchar(500) NOT NULL,
  `img` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `platforms`
--

INSERT INTO `platforms` (`id`, `name`, `description`, `link`, `img`) VALUES
(1, 'Photoshop', 'photoshop', 'https://www.adobe.com/fr/products/photoshop/landpb.html?gclid=Cj0KCQjwpompBhDZARIsAFD_Fp99VzJpYCA4iF-MACQwPCJimU6AsWovE5W1MaW0CQEBJtrT2W8fStQaAoCIEALw_wcB&mv=search&mv=search&mv2=paidsearch&sdid=2SLRC12G&ef_id=Cj0KCQjwpompBhDZARIsAFD_Fp99VzJpYCA4iF-MACQwPCJimU6AsWovE5W1MaW0CQEBJtrT2W8fStQaAoCIEALw_wcB:G:s&s_kwcid=AL!3085!3!592020161478!e!!g!!adobe%20photoshop!16832736920!134990730466&gad=1', 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/af/Adobe_Photoshop_CC_icon.svg/langfr-220px-Adobe_Photoshop_CC_icon.svg.png'),
(2, 'Premiere pro', 'Premiere pro', 'https://www.adobe.com/fr/products/premiere/campaign/pricing.html?gclid=Cj0KCQjwpompBhDZARIsAFD_Fp_aZA3x28Y9fpS9R5wvPH61rmznslvc8H4qQzQfAYbgluASev0k-YAaAlvEEALw_wcB&mv=search&mv=search&mv2=paidsearch&sdid=G4FRYP7G&ef_id=Cj0KCQjwpompBhDZARIsAFD_Fp_aZA3x28Y9fpS9R5wvPH61rmznslvc8H4qQzQfAYbgluASev0k-YAaAlvEEALw_wcB:G:s&s_kwcid=AL!3085!3!600117278398!e!!g!!adobe%20premiere%20pro!1435912734!56537474099&gad=1', 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/40/Adobe_Premiere_Pro_CC_icon.svg/langfr-1024px-Adobe_Premiere_Pro_CC_icon.svg.png'),
(3, 'Linkedin', 'LinkedIn', 'https://fr.linkedin.com/', 'https://upload.wikimedia.org/wikipedia/commons/c/ca/LinkedIn_logo_initials.png'),
(4, 'Wordpress', 'Wordpress', 'https://fr.wordpress.org/', 'https://upload.wikimedia.org/wikipedia/commons/9/93/Wordpress_Blue_logo.png'),
(5, 'Apple Shortcut', 'Apple Shortcut', 'https://support.apple.com/fr-fr/guide/shortcuts/welcome/ios', 'https://cdn.iconscout.com/icon/free/png-256/free-my-shortcuts-1859957-1575945.png');

-- --------------------------------------------------------

--
-- Structure de la table `postlikes`
--

DROP TABLE IF EXISTS `postlikes`;
CREATE TABLE IF NOT EXISTS `postlikes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user` int(10) NOT NULL,
  `post` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`user`),
  KEY `post` (`post`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `postlikes`
--

INSERT INTO `postlikes` (`id`, `user`, `post`) VALUES
(1, 12, 10),
(2, 5, 12),
(3, 7, 12),
(4, 11, 10),
(5, 6, 11),
(6, 11, 11),
(7, 9, 11),
(8, 5, 9),
(9, 3, 11),
(10, 2, 8);

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `createdDate` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `dateLastInteraction` date NOT NULL,
  `status` varchar(255) NOT NULL,
  `user` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`user`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `createdDate`, `dateLastInteraction`, `status`, `user`) VALUES
(8, 'Codons une automatisation de Facebook', 'Et si on sy mettait ?', '2023-11-06 09:06:25.000000', '2023-11-06', 'published', 5),
(9, 'Comment faire récupérer tous mes mots de passe de tous les sites', 'Avez-vous une solution?', '2023-11-03 09:08:19.000000', '2023-11-03', 'published', 6),
(10, 'Automatiser vos tâches répétitives avec Python', 'Découvrez comment utiliser Python pour simplifier vos processus quotidiens.', '2023-11-09 14:30:00.000000', '2023-11-09', 'draft', 7),
(11, 'Lavenir de lautomatisation dans le monde des affaires', 'Explorons les tendances émergentes de lautomatisation et leur impact sur les entreprises.', '2023-11-09 15:45:12.000000', '2023-11-09', 'published', 8),
(12, 'Les avantages cachés de lautomatisation domestique', 'Découvrez comment rendre votre vie quotidienne plus efficace en automatisant des tâches simples à la maison.', '2023-11-09 17:20:30.000000', '2023-11-09', 'pending', 9);

-- --------------------------------------------------------

--
-- Structure de la table `thematics`
--

DROP TABLE IF EXISTS `thematics`;
CREATE TABLE IF NOT EXISTS `thematics` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `color` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `thematics`
--

INSERT INTO `thematics` (`id`, `name`, `description`, `color`) VALUES
(1, 'Gestion de fichiers ', 'Scripts pour organiser et manipuler des fichiers et des dossiers.', '#3498DB'),
(2, 'Productivité personnelle', 'Automatisez des tâches pour augmenter votre efficacité personnelle.', '#1ABC9C'),
(3, 'Traitement de texte', 'Scripts pour automatiser des tâches liées au traitement de texte.', '#9B59B6'),
(4, 'Analyse de données', 'Automatisez l\'analyse et la manipulation de données.', '#F1C40F'),
(5, 'Administration système', 'Scripts pour simplifier la gestion de serveurs et de systèmes.', '#27AE60'),
(6, 'Sécurité informatique', 'Automatisez des tâches de sécurité et de protection des données.', '#E74C3C'),
(7, 'Automatisation des médias', 'Scripts pour la manipulation de médias comme la photo et la vidéo.', '#FF5733'),
(8, 'Développement web', 'Automatisez des tâches liées au développement web.', '#2980B9'),
(9, 'Réseaux sociaux', 'Scripts pour gérer et automatiser les activités sur les réseaux sociaux.', '#D35400'),
(10, 'E-commerce', 'Automatisez les processus liés à la gestion d\'une boutique en ligne.', '#E67E22');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(20) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(1) NOT NULL DEFAULT '0',
  `rank` int(255) NOT NULL DEFAULT '0',
  `profilPicture` varchar(255) NOT NULL DEFAULT 'https://image.noelshack.com/fichiers/2023/39/4/1695917629-efficincy-non-connecte.png',
  `isBanned` int(10) NOT NULL DEFAULT '0',
  `createdDate` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  PRIMARY KEY (`id`),
  KEY `isBan` (`isBanned`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nickname`, `lastName`, `firstName`, `email`, `password`, `role`, `rank`, `profilPicture`, `isBanned`, `createdDate`) VALUES
(2, 'FP', 'PINEL', 'Fabien', 'fabien.pinel08@gmail.com', '$2y$10$9qelafez/UYl3pURJFJzhuNZavufwcsQi1BagQoc/ff3bsqr4o5/K', 1, 601, 'https://image.noelshack.com/fichiers/2023/39/4/1695927798-avatar-h-1.png', 0, '2023-09-28 14:04:20.498704'),
(3, '   User', '   User', '   User', 'user@user.com', '$2y$10$u8E1WBR.OgNgNNQh/Yxj/e8ctLMjm.eZ/QpnGqC5IcsOmAQo8gQhS', 0, 0, 'https://image.noelshack.com/fichiers/2023/45/4/1699557537-avatar-h-2.png', 0, '2023-11-06 10:34:29.457871'),
(4, 'Admin', 'Admin', 'Admin', 'admin@admin.com', '$2y$10$Y7YhAlQTe4S9Saze.lFxeukK44Fwfh/yVdDgIDeIVN4/pAwHn2JgC', 1, 300, 'https://image.noelshack.com/fichiers/2023/39/4/1695917629-efficincy-non-connecte.png', 0, '2023-11-09 17:56:03.306540'),
(5, 'CyberShadow', 'Doe', 'John', 'john@example.com', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', 0, 210, 'https://image.noelshack.com/fichiers/2023/45/4/1699557537-avatar-h-2.png', 0, '2023-11-09 18:16:30.758763'),
(6, 'LunaStarlight', 'Smith', 'Alice', 'alice@example.com', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', 0, 0, 'https://image.noelshack.com/fichiers/2023/45/4/1699557537-avatar-f-1.png', 0, '2023-11-09 18:16:30.758763'),
(7, 'PixelNinja42', 'Johnson', 'Mike', 'mike@example.com', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', 0, 310, 'https://image.noelshack.com/fichiers/2023/45/4/1699557537-avatar-h-3.png', 0, '2023-11-09 18:16:30.758763'),
(8, 'PhoenixSword', 'Brown', 'Sarah', 'sarah@example.com', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', 0, 100, 'https://image.noelshack.com/fichiers/2023/45/4/1699557537-avatar-f-2.png', 0, '2023-11-09 18:16:30.758763'),
(9, 'MysticWhisp', 'Davis', 'Laura', 'laura@example.com', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', 0, 100, 'https://image.noelshack.com/fichiers/2023/45/4/1699557537-avatar-f-1.png', 0, '2023-11-09 18:16:30.758763'),
(10, 'SilverFoxGamer', 'Wilson', 'James', 'james@example.com', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', 0, 100, 'https://image.noelshack.com/fichiers/2023/45/4/1699557537-avatar-h-4.png', 0, '2023-11-09 18:16:30.758763'),
(11, 'QuantumDreamer', 'Taylor', 'Emma', 'emma@example.com', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', 0, 0, 'https://image.noelshack.com/fichiers/2023/45/4/1699557537-avatar-f-1.png', 0, '2023-11-09 18:16:30.758763'),
(12, 'AstralPhoenix', 'Miller', 'Oliver', 'oliver@example.com', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', 0, 110, 'https://image.noelshack.com/fichiers/2023/45/4/1699557537-avatar-h-2.png', 0, '2023-11-09 18:16:30.758763'),
(13, 'NeonSpectre', 'Martinez', 'Sophia', 'sophia@example.com', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', 0, 110, 'https://image.noelshack.com/fichiers/2023/45/4/1699557537-avatar-f-2.png', 0, '2023-11-09 18:16:30.758763'),
(14, 'CosmicJester', 'Brown', 'Emily', 'emily@example.com', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', 0, 421, 'https://image.noelshack.com/fichiers/2023/45/4/1699557537-avatar-f-2.png', 0, '2023-11-09 18:16:30.758763');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `bans`
--
ALTER TABLE `bans`
  ADD CONSTRAINT `bans_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Contraintes pour la table `cardlikes`
--
ALTER TABLE `cardlikes`
  ADD CONSTRAINT `cardlikes_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `cardlikes_ibfk_2` FOREIGN KEY (`card`) REFERENCES `cards` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `cards`
--
ALTER TABLE `cards`
  ADD CONSTRAINT `cards_ibfk_3` FOREIGN KEY (`platform`) REFERENCES `platforms` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `cards_ibfk_4` FOREIGN KEY (`thematic`) REFERENCES `thematics` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `cards_ibfk_5` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`card`) REFERENCES `cards` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_3` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Contraintes pour la table `commentsforums`
--
ALTER TABLE `commentsforums`
  ADD CONSTRAINT `commentsforums_ibfk_1` FOREIGN KEY (`post`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `commentsforums_ibfk_2` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`card`) REFERENCES `cards` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `favorites_ibfk_3` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Contraintes pour la table `postlikes`
--
ALTER TABLE `postlikes`
  ADD CONSTRAINT `postlikes_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `postlikes_ibfk_2` FOREIGN KEY (`post`) REFERENCES `posts` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Contraintes pour la table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
