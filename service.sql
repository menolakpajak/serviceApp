-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2023 at 05:19 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `service`
--

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE `data` (
  `id` int(11) NOT NULL,
  `no_spk` varchar(100) NOT NULL,
  `date` datetime NOT NULL,
  `date_proses` datetime DEFAULT NULL,
  `date_update` datetime DEFAULT NULL,
  `date_finish` datetime DEFAULT NULL,
  `date_pickup` datetime DEFAULT NULL,
  `counter` varchar(20) NOT NULL,
  `service_at` varchar(50) DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `wa` varchar(20) NOT NULL,
  `no_tlp` varchar(20) DEFAULT NULL,
  `tipe` varchar(100) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `sn` varchar(100) NOT NULL,
  `error` text NOT NULL,
  `result` text DEFAULT NULL,
  `cost` text DEFAULT NULL,
  `acc` varchar(10) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `pin` varchar(10) NOT NULL,
  `status` varchar(20) NOT NULL,
  `penerima` varchar(20) NOT NULL,
  `kelengkapan` longtext DEFAULT NULL,
  `signature` text DEFAULT NULL,
  `time_line` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`time_line`)),
  `log` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`log`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data`
--

INSERT INTO `data` (`id`, `no_spk`, `date`, `date_proses`, `date_update`, `date_finish`, `date_pickup`, `counter`, `service_at`, `nama`, `alamat`, `wa`, `no_tlp`, `tipe`, `unit`, `sn`, `error`, `result`, `cost`, `acc`, `note`, `pin`, `status`, `penerima`, `kelengkapan`, `signature`, `time_line`, `log`) VALUES
(4, '1698901NUCP', '2023-11-02 13:56:36', '2023-11-17 11:32:26', '2023-11-21 18:08:00', '2023-11-22 12:15:00', '2023-11-22 12:20:00', 'wtrg', 'JZ2TWM', 'made bahagia sejahtera', 'jl tkad pancoran 4 no 12b - panjer', '62817870770', '', 'canon', 'eos 5d mark 2', '8978798278', 'mati total\r\nflsh ga ngakat\r\njebol', 'mainboard korosi,\r\nflash tidak ngkat', 'mainboard = 2.000.000\r\nflash module = 350.000', 'on', 'urgent\r\nselesai 5 hari\r\nmau pulang kampung', 'on', 'done', 'mtr001', '{\n    \"check_kamera\": \"on\",\n    \"check_kamera_info\": \"ada baret\",\n    \"check_lensa\": \"\",\n    \"check_lensa_info\": \"\",\n    \"check_battery\": \"on\",\n    \"check_battery_info\": \"ori\",\n    \"check_memory\": \"on\",\n    \"check_memory_info\": \"8gb\",\n    \"check_strap\": \"\",\n    \"check_strap_info\": \"\",\n    \"check_bodycap\": \"on\",\n    \"check_bodycap_info\": \"\",\n    \"check_lenscap\": \"\",\n    \"check_lenscap_info\": \"\",\n    \"check_filter\": \"\",\n    \"check_filter_info\": \"\",\n    \"other\": \"\"\n}', NULL, NULL, '[\n    {\n        \"date\": \"2023-11-02 13:56:36\",\n        \"status\": \"input\",\n        \"action\": \"input\",\n        \"detail\": [\n            \"start input new data\"\n        ],\n        \"user\": \"mtr001\"\n    },\n    {\n        \"date\": \"2023-11-02 14:28:59\",\n        \"status\": \"new\",\n        \"action\": \"edit\",\n        \"detail\": [\n            \"Nama : made => made bahagia sejahtera\"\n        ],\n        \"user\": \"mtr001\"\n    },\n    {\n        \"date\": \"2023-11-02 19:41:39\",\n        \"status\": \"new\",\n        \"action\": \"edit\",\n        \"detail\": [\n            \"Pin :  => on\",\n            \"Note :  => urgent selesai 5 hari\"\n        ],\n        \"user\": \"mtr001\"\n    },\n    {\n        \"date\": \"2023-11-02 23:14:29\",\n        \"status\": \"new\",\n        \"action\": \"move\",\n        \"detail\": [\n            \"Perpindahan status dari NEW => PROSES\"\n        ],\n        \"user\": \"mtr001\"\n    },\n    {\n        \"date\": \"2023-11-10 13:58:00\",\n        \"status\": \"new\",\n        \"action\": \"edit\",\n        \"detail\": [\n            \"Kerusakan : mati total => mati total bos\"\n        ],\n        \"user\": \"mtr001\"\n    },\n    {\n        \"date\": \"2023-11-13 11:40:29\",\n        \"status\": \"new\",\n        \"action\": \"move\",\n        \"detail\": [\n            \"Perpindahan status dari NEW => PROSES\"\n        ],\n        \"user\": \"mtr001\"\n    },\n    {\n        \"date\": \"2023-11-13 11:42:55\",\n        \"status\": \"new\",\n        \"action\": \"move\",\n        \"detail\": [\n            \"Perpindahan status dari NEW => PROSES\"\n        ],\n        \"user\": \"mtr001\"\n    },\n    {\n        \"date\": \"2023-11-13 11:45:52\",\n        \"status\": \"new\",\n        \"action\": \"move\",\n        \"detail\": [\n            \"Perpindahan status dari NEW => PROSES\"\n        ],\n        \"user\": \"mtr001\"\n    },\n    {\n        \"date\": \"2023-11-17 11:27:44\",\n        \"status\": \"new\",\n        \"action\": \"edit\",\n        \"detail\": [\n            \"Note : urgent selesai 5 hari => urgent\\r\\nselesai 5 hari\\r\\nmau pulang kampung\",\n            \"Kerusakan : mati total bos => mati total\\r\\nflsh ga ngakat\\r\\njebol\"\n        ],\n        \"user\": \"mtr001\"\n    },\n    {\n        \"date\": \"2023-11-17 11:32:26\",\n        \"status\": \"new\",\n        \"action\": \"move\",\n        \"detail\": [\n            \"Perpindahan status dari NEW => PROSES\"\n        ],\n        \"user\": \"mtr001\"\n    },\n    {\n        \"date\": \"2023-11-17 11:49:56\",\n        \"status\": \"proses\",\n        \"action\": \"move\",\n        \"detail\": [\n            \"Perpindahan status dari PROSES => DONE\"\n        ],\n        \"user\": \"mtr001\"\n    },\n    {\n        \"date\": \"2023-11-17 20:30:04\",\n        \"status\": \"proses\",\n        \"action\": \"move\",\n        \"detail\": [\n            \"Perpindahan status dari PROSES => ABORT\"\n        ],\n        \"user\": \"mtr001\"\n    },\n    {\n        \"date\": \"2023-11-17 21:10:29\",\n        \"status\": \"proses\",\n        \"action\": \"move\",\n        \"detail\": [\n            \"Perpindahan status dari ABORT => PICKUP\"\n        ],\n        \"user\": \"mtr001\"\n    },\n    {\n        \"date\": \"2023-11-17 21:36:36\",\n        \"status\": \"proses\",\n        \"action\": \"move\",\n        \"detail\": [\n            \"Perpindahan status dari PROSES => DONE\"\n        ],\n        \"user\": \"mtr001\"\n    },\n    {\n        \"date\": \"2023-11-17 21:36:59\",\n        \"status\": \"proses\",\n        \"action\": \"move\",\n        \"detail\": [\n            \"Perpindahan status dari DONE => PICKUP\"\n        ],\n        \"user\": \"mtr001\"\n    },\n    {\n        \"date\": \"2023-11-17 21:46:29\",\n        \"status\": \"proses\",\n        \"action\": \"move\",\n        \"detail\": [\n            \"Perpindahan status dari PROSES => ABORT\"\n        ],\n        \"user\": \"mtr001\"\n    },\n    {\n        \"date\": \"2023-11-17 21:47:23\",\n        \"status\": \"proses\",\n        \"action\": \"move\",\n        \"detail\": [\n            \"Perpindahan status dari ABORT => PICKUP\"\n        ],\n        \"user\": \"mtr001\"\n    },\n    {\n        \"date\": \"2023-11-20 17:08:29\",\n        \"status\": \"proses\",\n        \"action\": \"move\",\n        \"detail\": [\n            \"Perpindahan status dari PROSES => DONE\"\n        ],\n        \"user\": \"mtr001\"\n    },\n    {\n        \"date\": \"2023-11-22 12:15\",\n        \"status\": \"proses\",\n        \"action\": \"move\",\n        \"detail\": [\n            \"Perpindahan status dari PROSES => DONE\"\n        ],\n        \"user\": \"mtr001\"\n    },\n    {\n        \"date\": \"2023-11-22 12:20\",\n        \"status\": \"proses\",\n        \"action\": \"move\",\n        \"detail\": [\n            \"Perpindahan status dari DONE => PICKUP\"\n        ],\n        \"user\": \"mtr001\"\n    }\n]'),
(5, '1700278XVLD', '2023-11-18 11:41:04', '2023-11-20 16:56:44', NULL, '2023-11-20 17:01:55', NULL, 'wtrg', 'SNR', 'botok dari lahir', 'jl merta dadi no 1, jimbaran', '62817870770', '081672536565', 'nikon', 'nikon d750', '87726176', 'jamuran pada sensor', NULL, NULL, '', '', '', 'proses', 'mtr001', '{\n    \"check_kamera\": \"on\",\n    \"check_kamera_info\": \"\",\n    \"check_lensa\": \"\",\n    \"check_lensa_info\": \"\",\n    \"check_battery\": \"\",\n    \"check_battery_info\": \"\",\n    \"check_memory\": \"\",\n    \"check_memory_info\": \"\",\n    \"check_strap\": \"on\",\n    \"check_strap_info\": \"\",\n    \"check_bodycap\": \"on\",\n    \"check_bodycap_info\": \"\",\n    \"check_lenscap\": \"\",\n    \"check_lenscap_info\": \"\",\n    \"check_filter\": \"\",\n    \"check_filter_info\": \"\",\n    \"other\": \"- plate tripod\\r\\n- tas bag\"\n}', NULL, NULL, '[\n    {\n        \"date\": \"2023-11-18 11:41:04\",\n        \"status\": \"input\",\n        \"action\": \"input\",\n        \"detail\": [\n            \"start input new data\"\n        ],\n        \"user\": \"mtr001\"\n    },\n    {\n        \"date\": \"2023-11-18 11:41:24\",\n        \"status\": \"new\",\n        \"action\": \"move\",\n        \"detail\": [\n            \"Perpindahan status dari NEW => PROSES\"\n        ],\n        \"user\": \"mtr001\"\n    },\n    {\n        \"date\": \"2023-11-20 16:56:44\",\n        \"status\": \"new\",\n        \"action\": \"move\",\n        \"detail\": [\n            \"Perpindahan status dari NEW => PROSES\"\n        ],\n        \"user\": \"mtr001\"\n    },\n    {\n        \"date\": \"2023-11-20 16:57:00\",\n        \"status\": \"proses\",\n        \"action\": \"move\",\n        \"detail\": [\n            \"Perpindahan status dari PROSES => DONE\"\n        ],\n        \"user\": \"mtr001\"\n    },\n    {\n        \"date\": \"2023-11-20 17:01:55\",\n        \"status\": \"proses\",\n        \"action\": \"move\",\n        \"detail\": [\n            \"Perpindahan status dari PROSES => ABORT\"\n        ],\n        \"user\": \"mtr001\"\n    }\n]'),
(7, '1700544MAJO', '2023-11-21 13:34:00', NULL, NULL, NULL, NULL, 'wtrg', NULL, 'totok', 'jl angkasa pura no 1', '62817870770', '', 'sony', 'a7 mark 2', '7483748', 'slot memory rusak', NULL, NULL, NULL, '', '', 'new', 'mtr001', '{\n    \"check_kamera\": \"on\",\n    \"check_kamera_info\": \"karet melar\",\n    \"check_lensa\": \"\",\n    \"check_lensa_info\": \"\",\n    \"check_battery\": \"\",\n    \"check_battery_info\": \"\",\n    \"check_memory\": \"\",\n    \"check_memory_info\": \"\",\n    \"check_strap\": \"\",\n    \"check_strap_info\": \"\",\n    \"check_bodycap\": \"\",\n    \"check_bodycap_info\": \"\",\n    \"check_lenscap\": \"\",\n    \"check_lenscap_info\": \"\",\n    \"check_filter\": \"\",\n    \"check_filter_info\": \"\",\n    \"other\": \"\"\n}', NULL, NULL, '[\n    {\n        \"date\": \"2023-11-21 13:34\",\n        \"status\": \"input\",\n        \"action\": \"input\",\n        \"detail\": [\n            \"start input new data\"\n        ],\n        \"user\": \"mtr001\"\n    }\n]');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `kode` varchar(50) NOT NULL,
  `link` varchar(50) DEFAULT NULL,
  `qts` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`qts`)),
  `deskripsi` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `buy` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`buy`)),
  `margin` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`margin`)),
  `sell` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`sell`)),
  `profit` varchar(100) NOT NULL,
  `subtotal` varchar(100) NOT NULL,
  `dpp` varchar(100) NOT NULL,
  `ppn` varchar(100) NOT NULL,
  `deposit` varchar(100) NOT NULL,
  `total` varchar(100) NOT NULL,
  `save_as` varchar(20) NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  `note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `date`, `kode`, `link`, `qts`, `deskripsi`, `buy`, `margin`, `sell`, `profit`, `subtotal`, `dpp`, `ppn`, `deposit`, `total`, `save_as`, `status`, `note`) VALUES
(1, '2023-11-24 01:21:00', 'INV-20231124RFD', '', '[\"1\",\"1\"]', '[\"Cleaning Sensor APSC\",\"Cleaning Lensa\"]', '[\"0\",\"0\"]', '[\"0\",\"0\"]', '[\"200,000\",\"500,000\"]', '200,000', '200,000', '180,180', '19,820', '0', '200,000', 'quotation', 'pending', '');

-- --------------------------------------------------------

--
-- Table structure for table `logininfo`
--

CREATE TABLE `logininfo` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `akses` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `kodeuser` varchar(50) NOT NULL,
  `token` varchar(50) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logininfo`
--

INSERT INTO `logininfo` (`id`, `username`, `password`, `akses`, `nama`, `kodeuser`, `token`, `status`) VALUES
(1, 'sangut', '$2y$10$mBDnU02.QhJWICF6VR8Vn.7jWMJS694VT2oHDWfOS.CQi/eeTmjDi', 'master', 'putu', 'mtr001', 'oQg5Fx%@!789Er1ncveaTjBXqD?I3JM4pmL&hd06', 'online'),
(3, 'made', '$2y$10$WFwBzJnc0W77SE0/.dRXuOIfy.UjgRDYqzOdwFzCX08iOcQMpJqQS', 'admin', 'made', 'adm001', 'cguKvpfmaedkM32W4UFX!xPq59BRt7jiwr6C&1@l', 'offline');

-- --------------------------------------------------------

--
-- Table structure for table `notif_msg`
--

CREATE TABLE `notif_msg` (
  `id` int(11) NOT NULL,
  `no_spk` varchar(200) NOT NULL,
  `date` datetime DEFAULT NULL,
  `date_wa` datetime DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `klik` varchar(5) DEFAULT NULL,
  `wa` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_center`
--

CREATE TABLE `service_center` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `kode` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `up_to` varchar(100) DEFAULT NULL,
  `no_tlp` text NOT NULL,
  `alamat` text NOT NULL,
  `unit` varchar(200) DEFAULT NULL,
  `legal_name` varchar(100) DEFAULT NULL,
  `rek_number` text DEFAULT NULL,
  `note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_center`
--

INSERT INTO `service_center` (`id`, `date`, `kode`, `nama`, `up_to`, `no_tlp`, `alamat`, `unit`, `legal_name`, `rek_number`, `note`) VALUES
(1, '2023-11-10 11:17:36', 'JZ2TWM', 'aneka kacang', 'rosianah', '085773264588', 'jl. Gunung Sahari No.50A,\r\nRT.1/RW.1, Gn.Sahari Selatan,\r\nkec.Kemayoran, Kota Jakarta Pusat,\r\nDKI Jakarta 10610', 'sigma,ailite,zhiyun,', 'PT. Aneka Warna', '', ''),
(2, '2023-11-10 13:18:59', 'RUDWEC', 'data script', '', '0817870770', 'jl. Gunung Sahari No.50A,\nRT.1/RW.1, Gn.Sahari Selatan,\nkec.Kemayoran, Kota Jakarta Pusat,\nDKI Jakarta 10610', 'canon,huyon,printer cp,', '', '', 'service center canon'),
(4, '2023-11-13 11:40:01', 'G38BCR', 'Nikon', '', '0817870770', 'jl buntu no 1.', 'nikon', '', '', ''),
(5, '2023-11-17 10:41:45', 'SNR', 'sinar', 'Yasinta', '0817870770', 'jl. Waturenggong no. 137\r\nDenpasar - Bali', '', 'PT Sinar Sumber Makmur', '', ''),
(6, '2023-11-17 21:34:40', 'OKEGCA', 'energi solution', '', '0817899878', 'jl mangga no 2', 'ailite', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `version`
--

CREATE TABLE `version` (
  `id` int(11) NOT NULL,
  `versi` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `version`
--

INSERT INTO `version` (`id`, `versi`) VALUES
(1, '3.1.40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_spk` (`no_spk`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode` (`kode`);

--
-- Indexes for table `logininfo`
--
ALTER TABLE `logininfo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `kodeuser` (`kodeuser`),
  ADD UNIQUE KEY `token` (`token`);

--
-- Indexes for table `notif_msg`
--
ALTER TABLE `notif_msg`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_spk` (`no_spk`);

--
-- Indexes for table `service_center`
--
ALTER TABLE `service_center`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode` (`kode`);

--
-- Indexes for table `version`
--
ALTER TABLE `version`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data`
--
ALTER TABLE `data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `logininfo`
--
ALTER TABLE `logininfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notif_msg`
--
ALTER TABLE `notif_msg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_center`
--
ALTER TABLE `service_center`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `version`
--
ALTER TABLE `version`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
