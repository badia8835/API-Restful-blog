
CREATE DATABASE `blog2023`;


-- blog2023.articles definition

CREATE TABLE `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `url_image` varchar(255) NOT NULL,
  `category_id` varchar(100) NOT NULL,
  `content` longtext NOT NULL,
  PRIMARY KEY (`id`)
);


INSERT INTO blog2023.articles
(title, url_image, category_id, content)
VALUES('Mont-Blanc', 'https://www.intrepidtravel.com/sites/intrepid/files/styles/large/public/EU-Mont-Blanc-Mountains-scenic-landscape-meta-image-583565359-ss-1024x768.jpg', '1', 'Mont-Blanc');

INSERT INTO blog2023.articles
(title, url_image, category_id, content)
VALUES('saint-saveur', 'https://www.quebeclemag.com/wp-content/uploads/2018/07/mont-saint-sauveur.jpg', '3', 'saint-saveur');

INSERT INTO blog2023.articles
(title, url_image, category_id, content)
VALUES('Mont-tremblant', 'https://upload.wikimedia.org/wikipedia/commons/4/4b/Mont-Tremblant-09-06-07.jpg', '2', 'Mont-tremblant');



-- blog2023.categories definition

CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
); 


INSERT INTO blog2023.categories
(name)
VALUES('Hotel');

INSERT INTO blog2023.categories
(name)
VALUES('Camping');

INSERT INTO blog2023.categories
(name)
VALUES('Chalet');