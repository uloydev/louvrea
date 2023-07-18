-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Jul 18, 2023 at 07:33 AM
-- Server version: 10.11.2-MariaDB-1:10.11.2+maria~ubu2204
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `louvrea`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, NULL, NULL),
(2, 1, 2, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_06_18_105137_create_product_categories_table', 1),
(6, '2023_06_18_105144_create_products_table', 1),
(7, '2023_06_18_105149_create_orders_table', 1),
(8, '2023_06_18_110047_create_carts_table', 1),
(9, '2023_06_18_110514_create_order_items_table', 1),
(10, '2023_07_08_110418_create_vouchers_table', 1),
(11, '2023_07_16_153241_create_resellers_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `grand_total` int(10) UNSIGNED NOT NULL,
  `order_price` int(10) UNSIGNED NOT NULL,
  `shipping_price` int(10) UNSIGNED NOT NULL,
  `shipping_method` enum('KURIR TOKO') NOT NULL DEFAULT 'KURIR TOKO',
  `discount` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `voucher_id` int(10) UNSIGNED DEFAULT NULL,
  `awb_number` varchar(50) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `address_detail` varchar(255) DEFAULT NULL,
  `phone` varchar(20) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `status` enum('PENDING','PROCESSING','SHIPPING','FINISHED') NOT NULL DEFAULT 'PENDING',
  `payment_status` enum('1','2','3','4') NOT NULL DEFAULT '1' COMMENT '1=menunggu pembayaran, 2=sudah dibayar, 3=kadaluarsa, 4=batal',
  `snap_token` varchar(36) DEFAULT NULL,
  `payment_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `price` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `size` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `price` int(10) UNSIGNED NOT NULL,
  `stock` int(10) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `product_category_id` int(10) UNSIGNED NOT NULL,
  `is_carousel` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `size`, `description`, `price`, `stock`, `image`, `product_category_id`, `is_carousel`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Est dolorum natus.', '20ml', 'Aut quo quas eos cupiditate ipsa fugiat et. Sunt facilis atque consequuntur dolorum. Numquam et et voluptates. Illo aliquid quibusdam qui nihil eum. Rerum neque rem expedita earum est quam perferendis. In deserunt labore quidem aut et rem culpa quibusdam. Corrupti enim at necessitatibus earum animi.', 40000, 16, 'img/bbb.jpg', 1, 0, NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(2, 'Earum deserunt.', '60ml', 'Laborum voluptates mollitia dignissimos a nulla cupiditate et. Rem dignissimos dignissimos architecto ratione tempora doloremque ducimus. Eos rem et rerum numquam molestiae et. Dolorem qui culpa quaerat eum deleniti. Repudiandae occaecati voluptas eligendi ut est eum nulla. Nam quia in corporis cumque et nulla. Quo omnis consequuntur sed blanditiis fugiat aut.', 50000, 8, 'img/bbb.jpg', 1, 0, NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(3, 'Enim atque aut.', '40ml', 'Odio aut ut rerum temporibus. Expedita quam autem quia eos hic quod. Aut ea dicta rerum. Aspernatur excepturi officia cupiditate molestiae magni quam. Dolores eaque id perspiciatis explicabo. Blanditiis quis consequatur reiciendis a quia dolor. Possimus iusto ut est vel porro commodi velit. Velit commodi ut aliquam fugiat maiores sequi.', 80000, 12, 'img/bbb.jpg', 1, 0, NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(4, 'Quidem praesentium est sint.', '10ml', 'Non aut ut non non vel. Illum saepe et ex corporis. Quis a ipsam et enim ea in. Laboriosam enim architecto sed architecto quas et. Accusamus possimus nisi sed aut quod amet nisi. Eos illo dolorum unde asperiores ipsam excepturi magnam.', 70000, 2, 'img/bbb.jpg', 1, 0, NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(5, 'Et optio.', '30ml', 'Iste voluptas et doloremque ipsa aperiam ea. Explicabo aliquam unde alias sed officiis. Autem nobis modi aut explicabo quaerat. Voluptas ipsa ut ullam sit. Aspernatur voluptatem aut neque. Dicta eos et in officiis et.', 90000, 6, 'img/bbb.jpg', 1, 0, NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(6, 'Non enim natus.', '10ml', 'Hic commodi sed expedita sequi ut ut numquam earum. Sed pariatur quia qui modi tenetur dolore quaerat. Quis et et dolor aperiam voluptas ut rerum. Nihil saepe suscipit a earum non odio. Voluptatem quaerat et eveniet aspernatur. Repellendus est id autem laudantium officiis. Commodi dolorum dicta quia doloribus. Quia odio quia laborum voluptas et aliquam.', 90000, 14, 'img/bbb.jpg', 1, 0, NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(7, 'Nam eos.', '10ml', 'Tempore occaecati iste veniam aut qui deserunt quod. Molestiae suscipit corrupti aliquam exercitationem rerum aperiam accusamus. Harum esse nam aliquam laborum sequi. Commodi quo ratione est et. Exercitationem rem cupiditate laborum doloribus sit. Sit error autem consequuntur ut non eveniet et. Veniam possimus occaecati quod eveniet quae. Velit totam tempora saepe fugit temporibus. Laboriosam soluta necessitatibus atque ut adipisci.', 80000, 8, 'img/bbb.jpg', 1, 0, NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(8, 'Et similique voluptatum.', '30ml', 'Saepe non voluptas nihil suscipit. Recusandae sequi beatae maxime eligendi. Et suscipit deleniti hic id. Corporis velit accusamus dolorem et rerum atque. Fugit autem earum eum est voluptate. Saepe sed corporis et animi ut architecto rerum. Velit ea quia voluptate debitis nesciunt. Itaque eum ut id eum quia labore reiciendis.', 30000, 18, 'img/bbb.jpg', 1, 0, NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(9, 'Sed iste dolor consequatur.', '20ml', 'Magni reprehenderit voluptas accusantium optio eum. Ab veniam id est culpa aliquid sit quas. Fugit aspernatur quasi occaecati velit accusantium eveniet. Architecto neque modi est cum. Est quia aut perferendis dolores mollitia.', 90000, 12, 'img/bbb.jpg', 1, 0, NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(10, 'Natus odio rerum molestias.', '60ml', 'Impedit maxime nulla iusto. Sed impedit nihil deleniti reiciendis dolorum sed natus. Distinctio reiciendis illum voluptatibus et quaerat est repellendus. Et magnam neque unde natus. Voluptatum atque non magni et reprehenderit quia ut. Voluptatum ea voluptatem quaerat exercitationem. Quia voluptas ut explicabo. Ut officiis velit ex natus incidunt repellat.', 30000, 12, 'img/bbb.jpg', 1, 0, NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(11, 'Minima fugit.', '70ml', 'Corrupti dolor a repudiandae suscipit. Illo porro eius quidem quia consequatur. Est aperiam et iure ipsum culpa eaque. Occaecati dolorem vel voluptas qui cupiditate qui ab ratione. Unde ab officiis rerum quis inventore rerum in officia. Eaque et optio ab voluptas.', 30000, 8, 'img/bbb.jpg', 1, 0, NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(12, 'Velit quidem alias.', '40ml', 'Perspiciatis est voluptatem et fugit et accusamus iusto. Perferendis praesentium ea est ducimus ratione eum. Harum molestias perferendis nemo voluptatem reprehenderit non. At magni distinctio sed id aut. Autem neque ut illum ut officiis hic. Ut accusantium voluptatum doloremque et est magnam ea.', 50000, 2, 'img/bbb.jpg', 1, 0, NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(13, 'Et facilis amet voluptatibus.', '50ml', 'Vitae aliquam nam magni maiores qui. Explicabo et eum eveniet nulla mollitia dolorem. Ut quibusdam aspernatur iusto asperiores minus. Voluptatem ad optio temporibus ut odit dolores sed. Neque officiis qui eius distinctio dolores dolorem. Quia reiciendis accusamus quae earum quia molestiae quo. Libero et asperiores quis animi.', 60000, 4, 'img/bbb.jpg', 2, 0, NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(14, 'Recusandae impedit.', '20ml', 'Maxime eum ut magnam autem voluptatem. Placeat facere itaque cupiditate. Commodi omnis dolor id. Eveniet laboriosam mollitia assumenda fuga tempore. Corrupti odit optio tenetur assumenda praesentium pariatur et. Est itaque ipsa maiores nisi iusto sit. Ab ea numquam consequatur sed. Ipsa et doloribus similique et. Ab eos suscipit et veniam id aspernatur iste. Et maiores iure dolore blanditiis.', 20000, 16, 'img/bbb.jpg', 2, 0, NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(15, 'Consectetur rerum voluptate voluptatem.', '10ml', 'Occaecati sit velit ut. Et qui enim commodi optio molestiae doloremque eum id. Qui nisi illo at dolor. Corrupti eum quam ipsum inventore. Rerum et quia maxime maiores atque. Atque vel ducimus labore est nihil placeat. Labore vero odit a error voluptate alias laborum. Ad qui dignissimos qui voluptas beatae qui ut molestiae. Et qui inventore aut similique et cum eius.', 60000, 4, 'img/bbb.jpg', 2, 0, NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(16, 'Facere molestias fuga.', '20ml', 'Totam quis deserunt optio non voluptas. Id molestiae facere laboriosam quos dolore repudiandae officiis expedita. Modi consequatur pariatur et atque. Eaque iusto voluptatem aut ratione vel. Commodi hic voluptatem aut praesentium. Nobis voluptas voluptas omnis alias error. Quod sit magnam perferendis ea sunt officia. Et et est omnis error illum hic.', 70000, 4, 'img/bbb.jpg', 2, 0, NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(17, 'Earum iste qui.', '70ml', 'Sunt dolores dolore dolorem quisquam est nihil. Omnis inventore nisi quasi corrupti harum. Aut dignissimos ex non aut doloremque ipsa consequuntur. Eum expedita qui illum voluptates omnis. Neque dolor molestiae voluptas beatae. Quia autem illo ratione pariatur. Asperiores omnis autem iusto. Aut numquam doloribus et sequi porro.', 60000, 2, 'img/bbb.jpg', 2, 0, NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(18, 'Aut temporibus repellat numquam ducimus.', '80ml', 'Suscipit ab laudantium sint soluta reiciendis velit. Nulla est nobis neque ut a. Magnam nisi eos facilis et labore explicabo dolorem expedita. Possimus dolores nulla vero aliquam dolore sequi necessitatibus. Ullam est pariatur quasi delectus officia vel. Dicta asperiores illum consequuntur vero ut. Facere qui temporibus qui placeat vero. Autem voluptas nihil sunt tempore aut ut et. Ullam incidunt architecto iusto ea nemo deleniti in.', 90000, 14, 'img/bbb.jpg', 2, 0, NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(19, 'Ut ex ullam laborum.', '30ml', 'Quia dignissimos non laudantium odio nostrum aut. Odio soluta nihil quis. Et aut inventore qui et quibusdam et saepe. Totam ea alias qui aut assumenda minus quaerat. A autem in labore consectetur ex. Repellendus magni debitis minima voluptatem culpa dicta. Voluptatibus totam eligendi beatae quam modi et ut praesentium. Molestias culpa enim laboriosam natus architecto harum dolorem.', 40000, 16, 'img/bbb.jpg', 2, 0, NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(20, 'Rerum porro sit.', '50ml', 'Enim vel corporis excepturi ipsum qui expedita explicabo fugiat. Ut nesciunt laboriosam voluptatem dolor voluptas quaerat tenetur. Qui fugit modi maxime praesentium. Quaerat et est voluptatem. Tempora nam in quidem ad. Ea non debitis laudantium et tempore harum. Suscipit nisi eligendi animi eum ad.', 50000, 8, 'img/bbb.jpg', 2, 0, NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(21, 'Repudiandae ut dolores delectus.', '50ml', 'Omnis voluptatem in repudiandae veritatis eaque. Similique ut rerum ut molestiae consequuntur iste quos veniam. In quaerat quia harum consequuntur quia animi. In soluta molestias ut ut voluptatum. Nobis et nam tempore eos. Deleniti qui commodi excepturi fugiat minima. Ratione cum quod consequatur praesentium et distinctio. Nisi quia cupiditate ex impedit est. Voluptates officiis sapiente magni aliquam.', 80000, 6, 'img/bbb.jpg', 2, 0, NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(22, 'Odit iure fugiat.', '40ml', 'Quia doloremque ut sint molestiae officiis illum. Consequatur vero aliquid quisquam sunt. Quo eos odit nisi repudiandae quis suscipit. Molestiae ipsa dolor nobis blanditiis sed nesciunt tempora officiis. Praesentium nihil harum sint ratione non expedita sapiente nihil.', 20000, 18, 'img/bbb.jpg', 2, 0, NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(23, 'Dignissimos rerum corrupti.', '70ml', 'Autem rerum quam rerum. Consequuntur dolores sunt pariatur voluptatem tenetur placeat sed aut. Et molestiae laborum recusandae est. Saepe suscipit ducimus quis consequatur incidunt. Veritatis ea eos velit deleniti. Molestias ducimus totam est nesciunt aut aliquam laborum. Inventore eveniet quisquam delectus eum nisi officia. Officia fugit excepturi placeat ad nam magni. Architecto et iusto natus.', 20000, 8, 'img/bbb.jpg', 2, 0, NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(24, 'Fugiat temporibus quasi delectus.', '20ml', 'Necessitatibus repudiandae animi sint iusto accusamus culpa. Dolore aut laboriosam nostrum ad dignissimos dolores. Qui reiciendis et illum error sed ex. Ex et est dolore alias perspiciatis laboriosam. Quia labore officia sit eum ea maxime facilis. Aut laboriosam vitae quis aut rem id blanditiis. Molestiae consectetur inventore sunt molestiae neque sunt. Assumenda ratione tenetur perspiciatis consequatur eaque sit. Iure nulla et et expedita impedit voluptas laboriosam. Culpa eos qui quis.', 60000, 8, 'img/bbb.jpg', 2, 0, NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(25, 'Quia iste.', '50ml', 'Reprehenderit nihil sunt velit blanditiis fuga et tempora. Nisi et odio et suscipit quis vel. Accusantium et aut odio cumque quam veritatis odit. Ad vitae ut accusantium impedit ab esse delectus et. Ipsa beatae et et et.', 20000, 4, 'img/bbb.jpg', 3, 0, NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(26, 'Enim qui.', '80ml', 'Nihil vero corrupti dignissimos ducimus ut. Numquam unde maxime distinctio modi tempora eos dolorem. Magni impedit sed qui. Omnis sint dolorem et aliquam aut et qui. Dolor enim qui earum aut. Numquam rerum sit non id veritatis ad veritatis. Minus consequatur corporis delectus molestias quod neque qui. Repellat repudiandae vel incidunt porro aspernatur.', 60000, 16, 'img/bbb.jpg', 3, 0, NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(27, 'Soluta et sapiente.', '90ml', 'Mollitia quidem occaecati aliquam corrupti esse ut laborum qui. Consequuntur non officiis magnam praesentium cumque omnis molestias. Quo quibusdam debitis aut eum sequi vel quia fuga. Ea et optio animi error. Sed hic magnam dolores magnam.', 70000, 6, 'img/bbb.jpg', 3, 0, NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(28, 'Aperiam est modi.', '30ml', 'Corrupti harum et et id ad consequatur et. Quae fugit nostrum ipsa aliquam. Molestiae eos quasi nihil reiciendis itaque. Omnis eum odio nisi assumenda numquam atque. Omnis dolorum minima quis rerum unde ducimus unde porro. Molestiae est explicabo voluptatum in. Eaque amet tempore ullam praesentium est repudiandae nihil. Sequi unde qui impedit aperiam enim in et saepe.', 80000, 14, 'img/bbb.jpg', 3, 0, NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(29, 'Nemo debitis et.', '80ml', 'Autem quas debitis eos et fuga delectus. Possimus totam quas ullam non qui quia. Molestiae non placeat quaerat. Amet consequatur quisquam illum id. Consequatur quis numquam fugiat et dolorum aut quisquam neque. A aut maiores nihil dolor aut.', 40000, 4, 'img/bbb.jpg', 3, 0, NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(30, 'Repellat porro distinctio dolorem.', '50ml', 'Tempora omnis reprehenderit ab vero quisquam. Totam et qui fugit in quae ipsa fugiat sapiente. Vel molestias nihil omnis autem. Dignissimos sit autem soluta sint. Modi omnis dolores omnis laboriosam maxime aut aut sequi. Et mollitia sint ea molestiae consequatur. Sed consequatur similique voluptatibus nostrum animi nisi enim. Qui facilis maiores et et qui quibusdam nisi deleniti. Alias autem commodi quam tempora non dolor mollitia quisquam. Dolores tempora non esse dicta.', 40000, 14, 'img/bbb.jpg', 3, 0, NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(31, 'Maxime tempore et.', '30ml', 'Expedita in quod aliquam ut minima et quo. Odio magni porro qui velit est. Est provident rerum enim laborum dolor similique dolorem. Et autem modi illo ea quia. Quasi dolores nihil ipsam ea. Vero voluptatem aut vel exercitationem. Molestias et natus vel odit possimus et. Reprehenderit pariatur est cumque quod laudantium et ut.', 90000, 14, 'img/bbb.jpg', 3, 0, NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(32, 'Voluptates nemo dolores.', '20ml', 'Quaerat sit eius doloribus harum et ut. Nam ea optio voluptatem quibusdam commodi. Consequatur temporibus suscipit vitae provident ut. Fugiat saepe libero soluta aut earum quibusdam. Velit quia nostrum aliquid alias. Quae at impedit cupiditate modi animi et. Aut laboriosam similique cumque occaecati reprehenderit. Delectus itaque dolores rem sunt repellendus eos eos. Ut eos omnis ut repellat quae eius doloribus.', 70000, 4, 'img/bbb.jpg', 3, 0, NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(33, 'Aliquid voluptatibus nam occaecati sint.', '30ml', 'Quam quam est labore nostrum ut. Pariatur aspernatur necessitatibus neque. Recusandae est dolores eos saepe consequatur. Consequatur sapiente rem vero nulla placeat. Omnis sit doloribus occaecati aliquid eveniet aperiam. Omnis vero voluptas quaerat in ullam veniam. Fugit rerum ut eos est provident beatae occaecati. Ab distinctio autem sit id omnis deserunt.', 90000, 18, 'img/bbb.jpg', 3, 0, NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(34, 'Voluptate et sed.', '90ml', 'Ullam quia et id hic facere. Animi distinctio ipsam omnis velit itaque incidunt et. Voluptas magni placeat neque voluptatibus sint quisquam pariatur. Officia sed in dolores soluta nam illo iste. Eos vitae earum qui minus eligendi et dolorem minima. Rerum ut ad voluptatem itaque consectetur fugit.', 40000, 2, 'img/bbb.jpg', 3, 0, NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(35, 'Ratione beatae impedit.', '50ml', 'Pariatur expedita tenetur incidunt pariatur. Molestias possimus odio doloribus quisquam. Sit maxime sint non et ut explicabo. Dolores deserunt esse fugiat hic esse. Sunt amet dicta quis atque minus. Molestiae quia sit quasi ut minus officiis ut. Cupiditate itaque dignissimos ipsam odit sed. Consequatur modi aut deleniti ad. Quasi consequatur nostrum ex distinctio id quod.', 10000, 2, 'img/bbb.jpg', 3, 0, NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(36, 'Qui cum rerum.', '60ml', 'Eius amet dolorem tempore voluptatem quia. Accusamus debitis nesciunt fugit nostrum iure rem. Earum totam eos in sit reprehenderit voluptatibus alias. Molestiae recusandae nulla soluta deleniti at eum quam. Quo voluptatum laudantium odit consequatur asperiores. Quam nesciunt voluptatem rem ex et ea esse. Suscipit expedita numquam quasi consequatur qui quae aut. Aliquam occaecati eum accusamus iure inventore libero. Est ipsa numquam sit minima.', 50000, 4, 'img/bbb.jpg', 3, 0, NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(37, 'Cum quae consequatur.', '10ml', 'Rem sit id nisi esse molestias quis aliquam. Officiis ut ipsum ut aut molestiae distinctio. Est nesciunt incidunt id itaque animi ut dolorum nulla. Suscipit sit culpa nemo quod ut. Facere assumenda atque quasi nemo dolor. Esse laboriosam impedit dolore natus qui. Magnam aperiam autem tempora quos tenetur iure qui. Dolor tenetur voluptatem fuga voluptatem molestias. Repellendus soluta alias nemo. Saepe voluptas voluptate repudiandae alias dolore sit.', 30000, 2, 'img/bbb.jpg', 4, 0, NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(38, 'A facere quis velit.', '10ml', 'Molestiae ut labore atque recusandae. Ut ut ex corrupti est. Cumque cupiditate eveniet et autem. Delectus mollitia aspernatur magnam temporibus. Quia omnis minus unde libero ducimus quo. Qui qui sit totam accusamus. Iure sequi quia pariatur. Neque repellendus provident libero est. Aliquid animi velit ipsam. Soluta eligendi quis repellat dignissimos quas.', 10000, 18, 'img/bbb.jpg', 4, 0, NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(39, 'Vero quia omnis a.', '90ml', 'Quia consequatur rem modi est et voluptatibus. Voluptatem facilis consequatur dignissimos illo sit ea explicabo. Voluptatem earum non omnis est nisi. Quod laborum non eos quis. Omnis repellendus esse praesentium provident temporibus. Cumque fugit dolorum veritatis.', 40000, 2, 'img/bbb.jpg', 4, 0, NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(40, 'Enim sed illum distinctio.', '70ml', 'Et sit voluptas eaque quia. Ab rerum magnam omnis corrupti. Dolor veritatis quos est autem nihil a. Dolorem sit minima magni consequatur. Fuga laborum aut alias ut consequatur et voluptate. Ut est sed quo sed ipsam odit nihil ipsam.', 70000, 12, 'img/bbb.jpg', 4, 0, NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(41, 'Labore velit alias ut.', '30ml', 'Quis qui ducimus qui a quo repudiandae iure. Quisquam ipsum vero eaque nostrum aut. Incidunt ut ea molestiae nemo. Cupiditate maxime odio aut voluptatum nisi sed quo. Autem perferendis voluptas et consequuntur. Ipsam blanditiis pariatur quasi perspiciatis molestiae perspiciatis numquam. Sunt maiores aliquid iusto maxime in rem et id.', 60000, 18, 'img/bbb.jpg', 4, 0, NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(42, 'Laboriosam aut aut ea.', '30ml', 'Vitae totam perferendis aliquam officia. Cum optio sed harum dicta architecto. Et reprehenderit ipsa possimus. Corrupti voluptas voluptatem sapiente sit nostrum. Laudantium quam doloremque sit dolores iusto cupiditate. Et quis facere laudantium excepturi ad voluptate.', 80000, 12, 'img/bbb.jpg', 4, 0, NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(43, 'Dolorum rerum et.', '90ml', 'Illo ad sapiente ut sunt aut corrupti nobis ut. Provident voluptas nihil earum quis incidunt eaque autem. Recusandae rem et recusandae ex soluta inventore ut. Sunt natus est sapiente odio occaecati. Delectus repellat voluptate eveniet est velit laudantium. Voluptatem tempora omnis ut corporis voluptatem. Labore id earum veritatis. Incidunt qui totam voluptas et inventore rerum ad.', 70000, 16, 'img/bbb.jpg', 4, 0, NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(44, 'Necessitatibus et voluptatem.', '30ml', 'Labore minima maiores vero reprehenderit sed et. Debitis maiores quos illum voluptate minus rerum. Non natus est sed quasi alias sunt reiciendis. Eius error totam ut non. Eligendi suscipit corporis non molestias quis eius omnis. Aliquid eaque dignissimos eaque sed repudiandae.', 90000, 4, 'img/bbb.jpg', 4, 0, NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(45, 'Totam sunt laboriosam.', '90ml', 'Dolorem provident illo et qui id ducimus perferendis. Et nobis quos nostrum quasi autem sunt ea. Repudiandae sed minus neque id aut quo esse. Repellat consequuntur odio eum quis fugit. Eligendi est dicta voluptates impedit. Et ut mollitia placeat repudiandae maiores laboriosam non.', 70000, 4, 'img/bbb.jpg', 4, 0, NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(46, 'Est magni est.', '60ml', 'Necessitatibus ut unde ipsum ea temporibus commodi id. Nobis molestiae alias sed ipsum nesciunt quibusdam harum. Soluta quis illo ipsum temporibus. Autem sed impedit qui necessitatibus aut. Excepturi autem sunt quas cupiditate aut.', 30000, 12, 'img/bbb.jpg', 4, 0, NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(47, 'Vel maxime enim odio.', '90ml', 'Est temporibus consequatur voluptatem velit qui repellat. Dolore vel qui sequi voluptas recusandae tenetur nihil. Necessitatibus incidunt in quae voluptas. Ea saepe facere dolores distinctio ex cum. Occaecati molestias cumque non temporibus deserunt. Quidem omnis est et corrupti qui. Officiis officia iste aut at aut quidem. Nihil dolor in et vel quia corporis veniam.', 80000, 12, 'img/bbb.jpg', 4, 0, NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(48, 'Quaerat et eum voluptatem.', '80ml', 'Nostrum et illum animi iste. Veritatis optio facilis deserunt accusantium recusandae. Omnis ratione aliquid repellendus non. Voluptate illum repellendus magnam vel et facere repellendus dolores. Consequatur ducimus eligendi totam labore qui deserunt sunt. Nihil voluptatem velit esse recusandae nisi quo. Quia et odio eos pariatur. Sit autem et nihil et rerum laborum minima. Quasi temporibus minus laborum voluptas corporis accusantium exercitationem. Ut et et omnis officia ut.', 20000, 4, 'img/bbb.jpg', 4, 0, NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(49, 'Labore repellat dolor provident.', '90ml', 'Qui ut exercitationem porro dolores recusandae eum. Odit porro aut esse nihil qui. Necessitatibus enim sunt ut consectetur ut voluptatem ut. Architecto et nulla nisi reiciendis provident odio. Animi dolore eos autem corporis. Quia et exercitationem numquam ad. Odio hic impedit possimus odio. Sapiente qui non delectus quae consequuntur. Quia cumque beatae in praesentium labore.', 90000, 14, 'img/bbb.jpg', 5, 0, NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(50, 'Error saepe laborum.', '10ml', 'Dolorem omnis sunt quibusdam debitis quia dolores omnis. Placeat ad quaerat et sint ab ad. Iure rerum et sit voluptatem. Quia hic repellat et qui nisi. Delectus quo est atque repudiandae dolores. Possimus adipisci sapiente velit sit atque laboriosam similique.', 40000, 4, 'img/bbb.jpg', 5, 0, NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(51, 'Reprehenderit illo qui.', '10ml', 'Magnam quo voluptas architecto enim nesciunt eos provident. Sunt quaerat laudantium veritatis et. Sit incidunt excepturi quod delectus qui. Quasi veniam cupiditate vero voluptatibus eaque aut. Pariatur qui dolorum quia perferendis quo aut.', 50000, 4, 'img/bbb.jpg', 5, 0, NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(52, 'Dolorum aliquam voluptatum.', '70ml', 'Vitae adipisci rem atque a. Ipsam sit nemo quia autem. Adipisci et eos dolorum repudiandae cupiditate. Aperiam sapiente consequatur excepturi architecto beatae. Possimus nihil dignissimos vel voluptas eius.', 60000, 4, 'img/bbb.jpg', 5, 0, NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(53, 'Tempora enim officiis expedita.', '90ml', 'Aut molestiae natus recusandae voluptatem eius mollitia ut. Repellendus distinctio odio consequatur accusantium non in corrupti. Eveniet eius enim reprehenderit voluptatem. Velit eaque odio repellendus ullam dolor magni. Dolores eius earum aut sed. Molestiae ea sed qui deserunt minima cumque. Voluptas aut voluptas error.', 40000, 6, 'img/bbb.jpg', 5, 0, NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(54, 'Sequi consequatur voluptatibus.', '30ml', 'Autem labore dolor cupiditate magnam ipsam. Est beatae id quasi voluptas et at. Occaecati consequatur ratione et velit. Consequatur ipsum repudiandae rerum nemo dolor. Qui quia quo aut sed atque alias qui. Et harum voluptas aut.', 30000, 12, 'img/bbb.jpg', 5, 0, NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(55, 'Ullam beatae in distinctio reprehenderit.', '10ml', 'Omnis est illo eius ullam corrupti. Quidem aperiam sed facere saepe aspernatur quae tempore. Sint perferendis rerum dolorem ipsa delectus nostrum. Repellendus soluta quia quibusdam eligendi quis. Officiis error quo nobis voluptas aliquam ab qui. Mollitia omnis dignissimos aspernatur. Quia quia voluptatibus tempore iste. Voluptates quod neque ut mollitia aspernatur recusandae assumenda doloremque.', 70000, 4, 'img/bbb.jpg', 5, 0, NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(56, 'Nihil sit totam ipsam.', '80ml', 'Qui nostrum quis maxime at ex. Sed voluptatem autem aut et id eveniet enim. Odio quae quas occaecati quis minus est provident eius. Porro sequi facere fugit itaque similique sapiente molestiae. At illum cupiditate aut beatae est in aut. Placeat molestiae ducimus eius vel voluptates aut. Dolor corporis et a enim repellat voluptas.', 50000, 8, 'img/bbb.jpg', 5, 0, NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(57, 'Qui est animi sit.', '70ml', 'Beatae tempora quo veritatis et voluptate molestiae deleniti natus. Doloribus et vero soluta quia sit quae iusto. Repudiandae hic sint qui. Facilis nemo non voluptatem ea quia voluptas. Occaecati tempora consequatur impedit maiores esse. Nisi cupiditate nihil et non voluptas quisquam. A animi error facilis assumenda distinctio. Omnis sit adipisci nisi qui blanditiis inventore.', 70000, 10, 'img/bbb.jpg', 5, 0, NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(58, 'Non id ex.', '90ml', 'Culpa enim laborum et qui debitis maxime. Repellat eos porro earum necessitatibus incidunt. Consectetur iste nihil veniam. Velit rem voluptas perspiciatis veritatis aut qui eveniet. Est est laudantium quod libero incidunt saepe rerum. Temporibus quod mollitia quas ut.', 70000, 16, 'img/bbb.jpg', 5, 0, NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(59, 'Ipsum quaerat omnis.', '80ml', 'Optio architecto voluptas in. Consequatur saepe dolorem eos qui. Quae quia molestiae provident vel. Alias eveniet dolorem neque rerum quia. Odio dolorem aperiam voluptatibus autem maiores et. Voluptatem rem ad officiis labore quisquam natus. Voluptatem voluptas odit in ex expedita ducimus.', 40000, 6, 'img/bbb.jpg', 5, 0, NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(60, 'Qui ut exercitationem debitis.', '70ml', 'Blanditiis et quidem omnis delectus. Soluta modi inventore iure aut minus iure. Voluptates expedita reprehenderit commodi quod exercitationem tenetur molestias. Accusamus asperiores id rerum velit ratione eos aliquam. Rem pariatur tenetur enim consequuntur. Dolorem aut quis debitis ullam recusandae ipsam iusto. Quia porro omnis ut quas quo est dicta. Maiores vel sapiente et perspiciatis aliquid. Eaque illo fuga ut magni sint iusto sunt.', 10000, 14, 'img/bbb.jpg', 5, 0, NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'consectetur', NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(2, 'aut', NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(3, 'nulla', NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(4, 'iste', NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(5, 'accusantium', NULL, '2023-07-18 07:33:00', '2023-07-18 07:33:00');

-- --------------------------------------------------------

--
-- Table structure for table `resellers`
--

CREATE TABLE `resellers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `area` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `resellers`
--

INSERT INTO `resellers` (`id`, `area`, `phone`, `created_at`, `updated_at`) VALUES
(1, 'Jakarta', '0812-3456-7890', NULL, NULL),
(2, 'Bandung', '0856-7890-1234', NULL, NULL),
(3, 'Surabaya', '0877-1234-5678', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin','superadmin') NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `phone`, `address`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'User', 'user@test.com', '2023-07-18 07:33:00', NULL, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', 'PajJmkJmyB', '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(2, 'Admin', 'admin@test.com', '2023-07-18 07:33:00', NULL, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', 'cA0BIHwRwI', '2023-07-18 07:33:00', '2023-07-18 07:33:00'),
(3, 'Super Admin', 'superadmin@test.com', '2023-07-18 07:33:00', NULL, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'superadmin', 'zqpkRZ2ITF', '2023-07-18 07:33:00', '2023-07-18 07:33:00');

-- --------------------------------------------------------

--
-- Table structure for table `vouchers`
--

CREATE TABLE `vouchers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `quota` int(11) NOT NULL DEFAULT 0,
  `discount` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vouchers`
--

INSERT INTO `vouchers` (`id`, `code`, `quota`, `discount`, `created_at`, `updated_at`) VALUES
(1, 'wkwk', 5, 10000, NULL, NULL),
(2, 'coba', 5, 5000, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resellers`
--
ALTER TABLE `resellers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vouchers`
--
ALTER TABLE `vouchers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `resellers`
--
ALTER TABLE `resellers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vouchers`
--
ALTER TABLE `vouchers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
