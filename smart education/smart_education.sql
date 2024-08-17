SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";




CREATE TABLE IF NOT EXISTS student_info (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    r_no VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    department VARCHAR(50) NOT NULL,
    year VARCHAR(10) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


--

INSERT INTO 'student_info' ( 'name','r_no', 'email', 'password','department','year') VALUES
( 'admin', 1,'admin@gmail.com', 'admin@123',`IF`,`SY`);

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

