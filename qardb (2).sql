-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2022 at 04:16 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qardb`
--

-- --------------------------------------------------------

--
-- Table structure for table `addstat`
--

CREATE TABLE `addstat` (
  `id` int(11) NOT NULL,
  `stat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `addstat`
--

INSERT INTO `addstat` (`id`, `stat`) VALUES
(1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` bigint(20) NOT NULL,
  `Admin_Name` varchar(50) NOT NULL,
  `Admin_UserName` varchar(50) NOT NULL,
  `Admin_password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `Admin_Name`, `Admin_UserName`, `Admin_password`) VALUES
(1, 'Michael Bay', 'Michael', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `attendancedp`
--

CREATE TABLE `attendancedp` (
  `AdId` bigint(20) NOT NULL,
  `SubmissionId` bigint(20) NOT NULL,
  `AdTitle` varchar(50) NOT NULL,
  `AdClass` varchar(50) NOT NULL,
  `AdNature` varchar(50) NOT NULL,
  `AdBudget` varchar(50) NOT NULL,
  `AdSource` varchar(50) NOT NULL,
  `AdOrganizer` varchar(50) NOT NULL,
  `AdLevel` varchar(50) NOT NULL,
  `AdVenue` varchar(50) NOT NULL,
  `AdDateFrom` date NOT NULL,
  `AdDateTo` date NOT NULL,
  `AdHours` varchar(50) NOT NULL,
  `AdFilename` varchar(100) NOT NULL,
  `AdTempName` varchar(100) NOT NULL,
  `RevStat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendancedp`
--

INSERT INTO `attendancedp` (`AdId`, `SubmissionId`, `AdTitle`, `AdClass`, `AdNature`, `AdBudget`, `AdSource`, `AdOrganizer`, `AdLevel`, `AdVenue`, `AdDateFrom`, `AdDateTo`, `AdHours`, `AdFilename`, `AdTempName`, `RevStat`) VALUES
(1, 30, 'title', 'Fora', 'Inclusivity and Diversity', '12,000', 'Self Funded', 'org', 'National', 'school', '2021-01-12', '2022-12-12', '45', '3.3 to 3.5.docx', '6265-3.3 to 3.5.docx', 0),
(2, 14, '1st for mark', 'Seminar/Webinar', 'GAD Related', '40000.12', 'Self Funded', 'Polytechnic University of the Philippines', 'National', 'Sta. Mesa ', '2021-12-13', '2023-02-12', '45', 'FINAL-Capstone-Documentation-Chapter-1-5 9.docx', '8146-FINAL-Capstone-Documentation-Chapter-1-5 9.docx', 1);

-- --------------------------------------------------------

--
-- Table structure for table `attendancet`
--

CREATE TABLE `attendancet` (
  `AtId` bigint(20) NOT NULL,
  `SubmissionId` bigint(20) NOT NULL,
  `AtTitle` varchar(50) NOT NULL,
  `AtClass` varchar(50) NOT NULL,
  `AtNature` varchar(50) NOT NULL,
  `AtBudget` varchar(50) NOT NULL,
  `AtSource` varchar(50) NOT NULL,
  `AtOrganizer` varchar(50) NOT NULL,
  `AtLevel` varchar(50) NOT NULL,
  `AtVenue` varchar(50) NOT NULL,
  `AtDateFrom` date NOT NULL,
  `AtDateTo` date NOT NULL,
  `AtHours` varchar(50) NOT NULL,
  `AtFilename` varchar(100) NOT NULL,
  `AtTempName` varchar(100) NOT NULL,
  `RevStat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendancet`
--

INSERT INTO `attendancet` (`AtId`, `SubmissionId`, `AtTitle`, `AtClass`, `AtNature`, `AtBudget`, `AtSource`, `AtOrganizer`, `AtLevel`, `AtVenue`, `AtDateFrom`, `AtDateTo`, `AtHours`, `AtFilename`, `AtTempName`, `RevStat`) VALUES
(1, 14, 'Also a Title', 'Professional/Continuing Professional Development', 'GAD Related', '60.00', 'University Funded', 'humans', 'Local-PUP', 'namek', '2021-02-15', '2024-10-14', '1', '3.3 to 3.5.docx', '5412-3.3 to 3.5.docx', 1),
(2, 14, 'Futures Thinking', 'Workshop', 'Skills/Technical', '24,000', 'University Funded', 'Futures Thinking Manila', 'International', 'Zoom', '2021-08-24', '2021-09-30', '43', 'Atanque, Juhn Emmanuel F. BSIT 3-4 Activity 1.pdf', '1523-Atanque, Juhn Emmanuel F. BSIT 3-4 Activity 1.pdf', 0),
(3, 14, '3rd Title', 'Professional/Continuing Professional Development', 'Inclusivity and Diversity', '40000.12', 'Self Funded', 'Organize', 'National', 'places', '2021-01-14', '2022-12-12', '45', 'Capstone-Evaluation-Sheet Group 9 Prof Ran Montaril.docx', '1879-Capstone-Evaluation-Sheet Group 9 Prof Ran Montaril.docx', 0);

-- --------------------------------------------------------

--
-- Table structure for table `attendanceu`
--

CREATE TABLE `attendanceu` (
  `AuId` bigint(20) NOT NULL,
  `SubmissionId` bigint(20) NOT NULL,
  `AuDesc` varchar(50) NOT NULL,
  `AuDateStart` date NOT NULL,
  `AuDateComp` date NOT NULL,
  `AuStatus` varchar(50) NOT NULL,
  `AuFilename` varchar(100) NOT NULL,
  `AuTempName` varchar(100) NOT NULL,
  `RevStat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendanceu`
--

INSERT INTO `attendanceu` (`AuId`, `SubmissionId`, `AuDesc`, `AuDateStart`, `AuDateComp`, `AuStatus`, `AuFilename`, `AuTempName`, `RevStat`) VALUES
(1, 14, 'Pretty Gooder', '2021-03-28', '2039-06-28', 'Present', '3.3 to 3.5.docx', '6507-3.3 to 3.5.docx', 0),
(2, 14, 'Academic Council Meeting', '2021-08-05', '2021-08-05', 'Attended', 'Atanque, Juhn Emmanuel F. BSIT 3-4 Activity 4.docx', '6658-Atanque, Juhn Emmanuel F. BSIT 3-4 Activity 4.docx', 1),
(3, 14, 'Currently being postponed', '2021-01-13', '2022-01-13', 'Ongoing', 'Research data.docx', '8667-Research data.docx', 0);

-- --------------------------------------------------------

--
-- Table structure for table `awardorg`
--

CREATE TABLE `awardorg` (
  `AoId` bigint(20) NOT NULL,
  `SubmissionId` bigint(20) NOT NULL,
  `AoName` varchar(100) NOT NULL,
  `AoBody` varchar(100) NOT NULL,
  `AoPlace` varchar(100) NOT NULL,
  `AoDate` date NOT NULL,
  `AoLevel` varchar(100) NOT NULL,
  `AoFilename` varchar(100) NOT NULL,
  `AoTempName` varchar(100) NOT NULL,
  `RevStat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `awardorg`
--

INSERT INTO `awardorg` (`AoId`, `SubmissionId`, `AoName`, `AoBody`, `AoPlace`, `AoDate`, `AoLevel`, `AoFilename`, `AoTempName`, `RevStat`) VALUES
(1, 14, 'award name', 'certifiers', 'earth', '2021-01-14', 'National', 'Capstone-Evaluation-Sheet Group 9.pdf', '2420-Capstone-Evaluation-Sheet Group 9.pdf', 1),
(2, 14, 'another award orgs', 'certs', 'school', '2021-12-11', 'National', 'tables involved.docx', '1249-tables involved.docx', 0),
(3, 14, '3rd award', 'Polytechnic University of the Philippines', 'Manila', '2021-01-12', '', 'Activity 2.docx', '3389-Activity 2.docx', 0);

-- --------------------------------------------------------

--
-- Table structure for table `awards`
--

CREATE TABLE `awards` (
  `AwardsId` bigint(20) NOT NULL,
  `SubmissionId` bigint(20) NOT NULL,
  `AwAward` varchar(50) NOT NULL,
  `AwClass` varchar(50) NOT NULL,
  `AwBody` varchar(50) NOT NULL,
  `AwLevel` varchar(50) NOT NULL,
  `AwVenue` varchar(50) NOT NULL,
  `AwDateFrom` date NOT NULL,
  `AwDateTo` date NOT NULL,
  `AwFilename` varchar(100) NOT NULL,
  `AwTempName` varchar(100) NOT NULL,
  `RevStat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `awards`
--

INSERT INTO `awards` (`AwardsId`, `SubmissionId`, `AwAward`, `AwClass`, `AwBody`, `AwLevel`, `AwVenue`, `AwDateFrom`, `AwDateTo`, `AwFilename`, `AwTempName`, `RevStat`) VALUES
(1, 14, 'title', 'Extension', 'Awarders', 'National', 'place', '2021-11-11', '2021-12-11', 'Detailed-Use-Cases (1).docx', '7461-Detailed-Use-Cases (1).docx', 1),
(2, 14, 'another title', 'Research', 'd', 'International', 's', '2021-11-11', '2022-08-14', 'data dictionary.docx', '1929-data dictionary.docx', 0),
(3, 14, '3rd Title', 'Arts/Media/Culture & Sports', 'body', 'Local-PUP', 'places', '2021-01-12', '2023-12-13', 'scriptf for def.docx', '7568-scriptf for def.docx', 1),
(4, 14, '4th Award ', 'Service', 'Awarders', 'National', 'place', '2021-02-14', '2021-12-12', 'The LIST.docx', '2930-The LIST.docx', 0),
(5, 14, '5th', 'Extension', 'd', 'International', 's', '2021-12-13', '2022-10-14', 'Capstone-Evaluation-Sheet Group 9 Prof Ria Sagum.docx', '1322-Capstone-Evaluation-Sheet Group 9 Prof Ria Sagum.docx', 0),
(6, 30, 'This Award', 'Arts/Media/Culture & Sports', 'd', 'National', 'd', '2015-12-11', '2024-10-14', 'Atanque, Juhn Emmanuel F BSIT 4-4 Gawain 1, Oct 28,2021.docx', '7441-Atanque, Juhn Emmanuel F BSIT 4-4 Gawain 1, Oct 28,2021.docx', 0),
(7, 30, 'se', 'Arts/Media/Culture & Sports', 'e', 'International', 'd', '2021-12-15', '2023-12-14', 'Group 9 - Facullty Research Monitoring System.pdf', '4829-Group 9 - Facullty Research Monitoring System.pdf', 0),
(8, 14, 'Award on specialized field', 'Research', 'The institute of awarders', 'National', 'Manila', '2021-11-13', '2021-12-11', 'Atanque, Juhn Emmanuel F BSIT 4-4 Gawain 1, Oct 28,2021  .pdf', '7994-Atanque, Juhn Emmanuel F BSIT 4-4 Gawain 1, Oct 28,2021  .pdf', 1),
(9, 30, 's', 'Arts/Media/Culture & Sports', 's', 'International', 's', '2021-10-15', '2024-11-14', 'Activity 2.docx', '1469-Activity 2.docx', 0),
(10, 30, '4th', 'Research', 'd', 'National', 'd', '2021-11-14', '2022-10-13', 'Atanque Juhn Emmanuel F BSIT 4-4 Gawain 2 October 31,2021.pdf', '9087-Atanque Juhn Emmanuel F BSIT 4-4 Gawain 2 October 31,2021.pdf', 0),
(11, 33, 'awards of Guy', 'Research', 'award', 'International', 'place', '2021-11-12', '2021-12-30', 'Activity 2.docx', '6641-Activity 2.docx', 0),
(12, 35, 'awards for karen', 'Research', 'bod', 'National', 'place', '2021-11-11', '2021-12-12', 'Atanque, Juhn Emmanuel F. BSIT 3-4.pdf', '7157-Atanque, Juhn Emmanuel F. BSIT 3-4.pdf', 0),
(13, 36, 'For Kevin', 'Invention', 'comp', 'Local-PUP', 'place', '2021-01-13', '2023-12-12', 'Activity 2.docx', '1795-Activity 2.docx', 0),
(14, 36, '2nd kevein', 'Research', 'sdf', 'International', 'sdf', '2021-11-13', '2022-11-13', 'Atanque, Juhn Emmanuel F. BSIT 3-4 Activity 1.pdf', '8116-Atanque, Juhn Emmanuel F. BSIT 3-4 Activity 1.pdf', 0),
(15, 37, '1st for Lorenz', 'Profesional', 'body', 'International', 'place', '2021-05-11', '2021-12-11', '3.3 to 3.5.docx', '1250-3.3 to 3.5.docx', 0),
(16, 37, '2nd for Lorenz', 'Extension', 's', 'National', 'vem', '2021-11-15', '2022-11-14', 'Atanque, Juhn Emmanuel F BSIT 4-4 Gawain 1, Oct 28,2021  .pdf', '4662-Atanque, Juhn Emmanuel F BSIT 4-4 Gawain 1, Oct 28,2021  .pdf', 0),
(17, 38, 'Award on Outstanding Attendance', 'Research', 'PUP', 'National', 'Sta.Mesa Manila', '2020-01-30', '2021-01-11', '2020-CK-FOR-DICTATION-2.docx', '2209-2020-CK-FOR-DICTATION-2.docx', 0),
(18, 58, 'Awards in excellence', 'Research', 'Polytechnic', 'National', 'PUP', '2021-02-11', '2021-11-09', 'Atanque, Juhn Emmanuel F.  OCA.docx', '8314-Atanque, Juhn Emmanuel F.  OCA.docx', 0),
(19, 58, 'Another Award', 'Extension', 'PUP', 'National', 'PUP', '0000-00-00', '2021-02-01', '2020-CK-FOR-DICTATION-2.docx', '9196-2020-CK-FOR-DICTATION-2.docx', 0);

-- --------------------------------------------------------

--
-- Table structure for table `collaborators`
--

CREATE TABLE `collaborators` (
  `Id` bigint(20) NOT NULL,
  `iicwId` bigint(20) NOT NULL,
  `collaborator` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `collaborators`
--

INSERT INTO `collaborators` (`Id`, `iicwId`, `collaborator`) VALUES
(6, 1, 'Jonathan Joestar'),
(7, 1, 'Erina Joestar'),
(12, 2, 'David Davidson'),
(13, 3, 'Robert Robertson'),
(21, 4, 'James Jamie'),
(22, 4, 'David Davidson'),
(23, 4, 'Karen stephan');

-- --------------------------------------------------------

--
-- Table structure for table `college`
--

CREATE TABLE `college` (
  `CollegeId` int(11) NOT NULL,
  `College` varchar(50) NOT NULL,
  `CollegeName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `college`
--

INSERT INTO `college` (`CollegeId`, `College`, `CollegeName`) VALUES
(1, 'CAF', 'College of Accountancy and Finance'),
(2, 'CADBE', 'College of Architecture, Design and the Built Environment'),
(3, 'CAL', 'College of Arts and Letters '),
(4, 'CBA', 'College of Business Administration'),
(5, 'COC', 'College of Communication'),
(6, 'CCIS', 'College of Computer and Information Sciences'),
(7, 'COED', 'College of Education'),
(8, 'CE', 'College of Engineering'),
(9, 'CHK', 'College of Human Kinetics'),
(10, 'CL', 'College of Law'),
(11, 'CPSPA', 'College of Political Science and Public Administration'),
(12, 'CSSD', 'College of Social Sciences and Development '),
(13, 'CS', 'College of Science'),
(14, 'CTHTM', 'College of Tourism, Hospitality and Transportation Management ');

-- --------------------------------------------------------

--
-- Table structure for table `copyrightedoutput`
--

CREATE TABLE `copyrightedoutput` (
  `CoId` bigint(20) NOT NULL,
  `SubmissionId` bigint(20) NOT NULL,
  `CoClass` varchar(100) NOT NULL,
  `CoCategory` varchar(100) NOT NULL,
  `CoAgenda` varchar(100) NOT NULL,
  `CoTitle` varchar(100) NOT NULL,
  `CoInvolve` varchar(100) NOT NULL,
  `CoType` varchar(100) NOT NULL,
  `CoFundType` varchar(100) NOT NULL,
  `CoFundAmount` varchar(100) NOT NULL,
  `CoFundAgency` varchar(100) NOT NULL,
  `CoDateStart` date NOT NULL,
  `CoDateTarget` date NOT NULL,
  `CoDateCompleted` date NOT NULL,
  `CoCopyrightNum` varchar(100) NOT NULL,
  `CoCopyrightAgency` varchar(100) NOT NULL,
  `CoCopyrightYear` varchar(100) NOT NULL,
  `CoLevel` varchar(100) NOT NULL,
  `CoFilename` varchar(100) NOT NULL,
  `CoTempName` varchar(100) NOT NULL,
  `RevStat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `copyrightedoutput`
--

INSERT INTO `copyrightedoutput` (`CoId`, `SubmissionId`, `CoClass`, `CoCategory`, `CoAgenda`, `CoTitle`, `CoInvolve`, `CoType`, `CoFundType`, `CoFundAmount`, `CoFundAgency`, `CoDateStart`, `CoDateTarget`, `CoDateCompleted`, `CoCopyrightNum`, `CoCopyrightAgency`, `CoCopyrightYear`, `CoLevel`, `CoFilename`, `CoTempName`, `RevStat`) VALUES
(1, 14, 'Study', 'Book Chapter', 'Peace and Security', 'copyrighted research ', 'Lead Researcher', 'Applied Research ', 'University Funded', '232.00', 'Funders', '2021-03-12', '2021-02-13', '2021-12-11', 'ISSN 2012', 'Copyrighters', '2021', 'Provincial/City/Municipal', 'Activity 2.docx', '6298-Activity 2.docx', 1),
(2, 14, 'Project', 'Book Chapter', 'Peace and Security', 'Copyrighted Output of Ongoing Research', 'Co-Lead Researcher', 'Applied Research ', 'Self Funded', '3422', 'Mafia', '2021-11-12', '2015-11-12', '2022-10-13', 'ISSN ', 'Copyright claimers', '2021', 'International', 'FINAL-Capstone-Documentation-Chapter-1-5 9.docx', '1439-FINAL-Capstone-Documentation-Chapter-1-5 9.docx', 0),
(3, 38, 'Project', 'Book Chapter', ' Competitive Industry and Entrepreneurship', 'Differentials in Firm-Level Productivity and Corporate Governance: Evidence from Japanese Firm Data ', 'Independent Researcher', 'Applied Research ', 'Self Funded', '1,000', 'N/A', '2020-03-02', '2020-08-20', '2020-07-06', 'ISBN', 'Copyright ', '2020', 'Local-PUP', 'Creating Bio.docx', '3782-Creating Bio.docx', 0),
(4, 42, 'Study', 'Research', 'Peace and Security', 'Factors Affecting the Extent of Depression Treatment ', 'Lead Researcher', 'Applied Research ', 'Self Funded', '5,000', 'Land Bank', '2018-01-01', '2018-03-01', '2018-02-01', 'ISSN', 'Copyright Co.', '2018', 'Local-PUP', 'Capstone-Evaluation-Sheet Group 9.docx', '5903-Capstone-Evaluation-Sheet Group 9.docx', 0),
(5, 47, 'Project', 'Research', 'Peace and Security', 'Behavioral Extensions to the Topology of Fear', 'Independent Researcher', 'Creative Work ', 'University Funded', '3,000', 'PUP', '2019-04-02', '2019-06-21', '2019-04-30', 'ISSN', 'Co Agent', '2019', 'National', 'Capstone-Evaluation-Sheet Group 9 Prof Juancho Espineli.pdf', '8364-Capstone-Evaluation-Sheet Group 9 Prof Juancho Espineli.pdf', 0),
(6, 50, 'Project', 'Research', ' Competitive Industry and Entrepreneurship', 'Jumping on the Bandwagon: Conformity and Herd Behavior ', 'Lead Researcher', 'Applied Research ', 'Self Funded', '4,000', 'N/A', '2019-04-21', '2019-12-02', '2019-11-04', 'ISSN', 'Copyright Co.', '2019', 'National', 'GUI docu.docx', '5463-GUI docu.docx', 0),
(7, 57, 'Study', 'Research', 'Peace and Security', 'Exploring the Relationship between Video Games and Academic Achievement via Cross-sectional and Long', 'Co-Lead Researcher', 'Applied Research ', 'Self Funded', '34,222', 'N/A', '2021-04-03', '2021-02-01', '2021-11-03', 'ISSN', 'Copyright Co.', '2021', 'Local-PUP', 'Capstone-Evaluation-Sheet Group 9 Prof Juancho Espineli.pdf', '9204-Capstone-Evaluation-Sheet Group 9 Prof Juancho Espineli.pdf', 0);

-- --------------------------------------------------------

--
-- Table structure for table `co_keywords`
--

CREATE TABLE `co_keywords` (
  `CoKeywordsId` bigint(20) NOT NULL,
  `CoId` bigint(20) NOT NULL,
  `CoKeywords` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `co_keywords`
--

INSERT INTO `co_keywords` (`CoKeywordsId`, `CoId`, `CoKeywords`) VALUES
(56, 1, 'one'),
(57, 1, 'two'),
(58, 1, 'three'),
(59, 1, 'four'),
(60, 1, 'end'),
(66, 3, 'Firm-Level'),
(67, 3, 'Corporate Governance'),
(68, 3, 'Japanese'),
(69, 3, 'Corporate'),
(70, 3, 'Data'),
(71, 4, 'Poverty'),
(72, 4, 'Deppression'),
(73, 4, 'Treatment'),
(74, 4, 'Factors'),
(75, 4, 'Extent'),
(76, 5, 'Fear'),
(77, 5, 'Psychology'),
(78, 5, 'Topology'),
(79, 5, 'Extension'),
(80, 5, 'Behavior'),
(81, 6, 'Bandwagon'),
(82, 6, 'Conformity'),
(83, 6, 'Behavior'),
(84, 6, 'Herd'),
(85, 6, 'Industry'),
(86, 7, 'Games'),
(87, 7, 'Relationship'),
(88, 7, 'Achivement'),
(89, 7, 'Cross-relational'),
(90, 7, 'Academic'),
(96, 2, 'Timely'),
(97, 2, 'Social'),
(98, 2, 'Engaging'),
(99, 2, 'Revealing'),
(100, 2, 'Political');

-- --------------------------------------------------------

--
-- Table structure for table `co_name`
--

CREATE TABLE `co_name` (
  `CoNameId` bigint(20) NOT NULL,
  `CoId` bigint(20) NOT NULL,
  `CoName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `co_name`
--

INSERT INTO `co_name` (`CoNameId`, `CoId`, `CoName`) VALUES
(28, 1, 'Karen stephan'),
(31, 3, 'James Jameson'),
(32, 4, 'James Jameson'),
(33, 5, 'David Davidson'),
(34, 6, 'Giorno Giovani'),
(35, 6, 'Karen stephan'),
(36, 7, 'Marilyn Monroe'),
(39, 2, 'James Jamie'),
(40, 2, 'Mista');

-- --------------------------------------------------------

--
-- Table structure for table `eservice_conference`
--

CREATE TABLE `eservice_conference` (
  `ConId` bigint(20) NOT NULL,
  `SubmissionId` bigint(20) NOT NULL,
  `EConferenceNature` varchar(100) NOT NULL,
  `EConferenceTitle` varchar(100) NOT NULL,
  `EConferenceAgency` varchar(100) NOT NULL,
  `EConferenceVenue` varchar(100) NOT NULL,
  `EConferenceDateFrom` date NOT NULL,
  `EConferenceDateTo` date NOT NULL,
  `EConferenceLevel` varchar(100) NOT NULL,
  `EConferenceFilename` varchar(100) NOT NULL,
  `EConferenceTempName` varchar(100) NOT NULL,
  `RevStat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `eservice_conference`
--

INSERT INTO `eservice_conference` (`ConId`, `SubmissionId`, `EConferenceNature`, `EConferenceTitle`, `EConferenceAgency`, `EConferenceVenue`, `EConferenceDateFrom`, `EConferenceDateTo`, `EConferenceLevel`, `EConferenceFilename`, `EConferenceTempName`, `RevStat`) VALUES
(1, 14, 'Coordinator', 'Work', 'Partnerz', 'School Grounds', '2020-01-12', '2022-12-12', 'Provincial', 'Group 9 week 4 Prototype Progress.docx', '9657-Group 9 week 4 Prototype Progress.docx', 1),
(2, 14, 'Lecturer', 'trainz', 'gents', 'ven', '2021-12-11', '2022-12-13', 'National', 'Research data.docx', '2050-Research data.docx', 0);

-- --------------------------------------------------------

--
-- Table structure for table `eservice_consultant`
--

CREATE TABLE `eservice_consultant` (
  `EcId` bigint(20) NOT NULL,
  `SubmissionId` bigint(20) NOT NULL,
  `EConsultantClass` varchar(100) NOT NULL,
  `EConsultantTitle` varchar(100) NOT NULL,
  `EConsultantCategory` varchar(100) NOT NULL,
  `EConsultantAgency` varchar(100) NOT NULL,
  `EConsultantVenue` varchar(100) NOT NULL,
  `EConsultantDateFrom` date NOT NULL,
  `EConsultantDateTo` date NOT NULL,
  `EConsultantLevel` varchar(100) NOT NULL,
  `EFilename` varchar(100) NOT NULL,
  `ETempName` varchar(100) NOT NULL,
  `RevStat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `eservice_consultant`
--

INSERT INTO `eservice_consultant` (`EcId`, `SubmissionId`, `EConsultantClass`, `EConsultantTitle`, `EConsultantCategory`, `EConsultantAgency`, `EConsultantVenue`, `EConsultantDateFrom`, `EConsultantDateTo`, `EConsultantLevel`, `EFilename`, `ETempName`, `RevStat`) VALUES
(1, 14, 'Technology', 'Techstuff', 'expert', 'Partners', 'school', '2021-10-14', '2040-01-13', 'International     ', 'tables involved.docx', '8391-tables involved.docx', 1),
(2, 14, 'Arts & Sports', 'Arts Title', 'Experts', 'Agents', 'Venues', '2021-01-15', '2021-02-12', 'National', 'FINAL-Capstone-Documentation-Chapter-1-5 9.docx', '6045-FINAL-Capstone-Documentation-Chapter-1-5 9.docx', 0);

-- --------------------------------------------------------

--
-- Table structure for table `extensionprogram`
--

CREATE TABLE `extensionprogram` (
  `EpId` bigint(20) NOT NULL,
  `SubmissionId` bigint(20) NOT NULL,
  `EPProgramTitle` varchar(100) NOT NULL,
  `EPProjectTitle` varchar(100) NOT NULL,
  `EPActivityTitle` varchar(100) NOT NULL,
  `EPNature` varchar(100) NOT NULL,
  `EPFundSource` varchar(100) NOT NULL,
  `EPFundAmount` varchar(100) NOT NULL,
  `EPClass` varchar(100) NOT NULL,
  `EPPartnership` varchar(100) NOT NULL,
  `EPDateFrom` date NOT NULL,
  `EPDateTo` date NOT NULL,
  `EPStatus` varchar(100) NOT NULL,
  `EPVenue` varchar(100) NOT NULL,
  `EPTraineeNum` varchar(100) NOT NULL,
  `EPTraineeClass` varchar(100) NOT NULL,
  `EPHours` varchar(50) NOT NULL,
  `EPFilename` varchar(100) NOT NULL,
  `EPTempName` varchar(100) NOT NULL,
  `RevStat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `extensionprogram`
--

INSERT INTO `extensionprogram` (`EpId`, `SubmissionId`, `EPProgramTitle`, `EPProjectTitle`, `EPActivityTitle`, `EPNature`, `EPFundSource`, `EPFundAmount`, `EPClass`, `EPPartnership`, `EPDateFrom`, `EPDateTo`, `EPStatus`, `EPVenue`, `EPTraineeNum`, `EPTraineeClass`, `EPHours`, `EPFilename`, `EPTempName`, `RevStat`) VALUES
(1, 14, 'extension prog', 'extension proj', 'activity', 'Resource Speaker', 'Self Funded', '14,000', 'Local Governance', 'Regional', '2021-01-30', '2021-04-12', 'Completed', 'ven', '55', 'classss', '45', 'Group 9 - Facullty Research Monitoring System.docx', '6113-Group 9 - Facullty Research Monitoring System.docx', 0),
(2, 14, '2nd extension', '2nd project', '2nd activity', 'Resource Speaker', 'Self Funded', '40111', 'Livelihood Development', 'Provincial/City/Municipal', '2021-03-31', '2021-05-30', 'Completed', 'Sta. Mesa', '100', 'students', '21', 'progress.docx', '4374-progress.docx', 1);

-- --------------------------------------------------------

--
-- Table structure for table `extension_journals`
--

CREATE TABLE `extension_journals` (
  `EjId` bigint(20) NOT NULL,
  `SubmissionId` bigint(20) NOT NULL,
  `EjJournals` varchar(100) NOT NULL,
  `EjNature` varchar(100) NOT NULL,
  `EjPublication` varchar(100) NOT NULL,
  `EjIndexing` varchar(100) NOT NULL,
  `EjCopyright` varchar(100) NOT NULL,
  `EjLevel` varchar(100) NOT NULL,
  `EjFilename` varchar(100) NOT NULL,
  `EjTempName` varchar(100) NOT NULL,
  `RevStat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `extension_journals`
--

INSERT INTO `extension_journals` (`EjId`, `SubmissionId`, `EjJournals`, `EjNature`, `EjPublication`, `EjIndexing`, `EjCopyright`, `EjLevel`, `EjFilename`, `EjTempName`, `RevStat`) VALUES
(1, 14, 'Newsletter', 'Editor', 'Audio', 'CHED Recognized Journals', 'E-ISSN', 'Provincial/City/Municipal', 'Capstone-Evaluation-Sheet Group 9.pdf', '7180-Capstone-Evaluation-Sheet Group 9.pdf', 1),
(2, 14, 'Creative Works', 'Coordinator', 'Publish And visual Co.', 'ASEAN Citation Index', '34', 'Regional', 'data dictionary.docx', '7827-data dictionary.docx', 0);

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `Faculty_id` int(11) NOT NULL,
  `FacultyNumber` varchar(50) NOT NULL,
  `Status` varchar(50) NOT NULL,
  `College` varchar(50) NOT NULL,
  `UserLevel` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`Faculty_id`, `FacultyNumber`, `Status`, `College`, `UserLevel`) VALUES
(1, '211', 'Active', 'CCIS', 'Faculty Member'),
(2, '222', 'Active', 'CCIS', 'Faculty Member'),
(3, '223', 'Active', 'CCIS', 'Dean'),
(4, '224', 'Active', 'CHK', 'Dean'),
(5, '225', 'Active', 'COED', 'Dean'),
(6, '226', 'Active', 'CL', 'Dean'),
(7, '227', 'Active', 'CL', 'Researcher'),
(8, '228', 'Active', 'CCIS', 'Faculty Member'),
(9, '229', 'Active', 'CL', 'Faculty Member'),
(10, '230', 'Active', 'CL', 'Faculty Member'),
(11, '231', 'Active', 'CHK', 'Faculty Member'),
(12, '232', 'Active', 'CCIS', 'Faculty Member'),
(13, '233', 'Active', 'CCIS', 'Faculty Member'),
(14, '234', 'Active', 'CCIS', 'Faculty Member'),
(15, '235', 'In-Active', 'CHK', 'Faculty Member'),
(16, '236', 'Active', 'CCIS', 'Researcher'),
(17, '237', 'Active', 'CL', 'Faculty Member'),
(18, '333', 'In-Active', 'COED', 'Faculty Member'),
(19, '255', 'In-Active', 'CHK', 'Faculty Member'),
(20, '455', 'Active', 'CCIS', 'Faculty Member'),
(21, '1000', 'Active', 'CCIS', 'Faculty Member');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `FeedbackId` bigint(20) NOT NULL,
  `SubmissionId` bigint(20) NOT NULL,
  `UserId` bigint(20) NOT NULL,
  `FeedbackDetails` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`FeedbackId`, `SubmissionId`, `UserId`, `FeedbackDetails`) VALUES
(5, 14, 3, 'My feedback for the second time'),
(6, 30, 1, 'asdasdasdad'),
(7, 33, 10, 'fo guy'),
(8, 35, 9, 'fo karen'),
(9, 37, 14, 'for lorenz');

-- --------------------------------------------------------

--
-- Table structure for table `iicw`
--

CREATE TABLE `iicw` (
  `iicwId` bigint(20) NOT NULL,
  `SubmissionId` bigint(20) NOT NULL,
  `ITitle` varchar(100) NOT NULL,
  `IClass` varchar(100) NOT NULL,
  `IDurationFrom` date NOT NULL,
  `IDurationTo` date NOT NULL,
  `INature` varchar(100) NOT NULL,
  `IStatus` varchar(100) NOT NULL,
  `IAgency` varchar(100) NOT NULL,
  `IFundingType` varchar(100) NOT NULL,
  `IFundingAmount` varchar(100) NOT NULL,
  `IFilename` varchar(100) NOT NULL,
  `ITempName` varchar(100) NOT NULL,
  `RevStat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `iicw`
--

INSERT INTO `iicw` (`iicwId`, `SubmissionId`, `ITitle`, `IClass`, `IDurationFrom`, `IDurationTo`, `INature`, `IStatus`, `IAgency`, `IFundingType`, `IFundingAmount`, `IFilename`, `ITempName`, `RevStat`) VALUES
(1, 14, 'Invention', 'Innovation', '2021-02-11', '2021-12-12', 'Machinery', 'Deferred', 'Speedwagon', 'Self Funded', '32131.00', 'Group 9 - Facullty Research Monitoring System.pdf', '5676-Group 9 - Facullty Research Monitoring System.pdf', 0),
(2, 14, 'Creative', 'Invention', '2020-12-31', '2021-12-13', 'It Products', 'Completed', 'Funders', 'Self Funded', '8210', 'Capstone-Evaluation-Sheet Group 9 Prof Ria Sagum.pdf', '2331-Capstone-Evaluation-Sheet Group 9 Prof Ria Sagum.pdf', 1),
(3, 14, 'Innovate', 'Innovation', '2021-01-31', '2021-10-11', 'Equipments', 'Completed', 'agents', 'Self Funded', '65', 'Atanque, Juhn Emmanuel F. BSIT 3-4 Activity 3.docx', '7768-Atanque, Juhn Emmanuel F. BSIT 3-4 Activity 3.docx', 0),
(4, 14, 'Innovative invention for farming', 'Innovation', '2020-01-14', '2021-01-11', 'Equip', 'Completed', 'funding agency', 'Externally Funded', '22000.34', 'data dictionary.docx', '5088-data dictionary.docx', 0);

-- --------------------------------------------------------

--
-- Table structure for table `inolvementmobility`
--

CREATE TABLE `inolvementmobility` (
  `IMId` bigint(20) NOT NULL,
  `SubmissionId` bigint(20) NOT NULL,
  `IMNature` varchar(100) NOT NULL,
  `IMType` varchar(100) NOT NULL,
  `IMHost` varchar(100) NOT NULL,
  `IMAddress` varchar(100) NOT NULL,
  `IMDateFrom` date NOT NULL,
  `IMDateTo` date NOT NULL,
  `IMFilename` varchar(100) NOT NULL,
  `IMTempName` varchar(100) NOT NULL,
  `RevStat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inolvementmobility`
--

INSERT INTO `inolvementmobility` (`IMId`, `SubmissionId`, `IMNature`, `IMType`, `IMHost`, `IMAddress`, `IMDateFrom`, `IMDateTo`, `IMFilename`, `IMTempName`, `RevStat`) VALUES
(1, 14, 'Sports Delegates', 'Internship', 'host', 'stages', '2021-02-11', '2023-12-14', 'progress.docx', '9299-progress.docx', 1),
(2, 14, 'Resource Person/Speaker/Panel', 'Internship', 'institute', 'Sta. Mesa', '2021-01-30', '2021-02-11', 'data dictionary.docx', '6057-data dictionary.docx', 0);

-- --------------------------------------------------------

--
-- Table structure for table `membership`
--

CREATE TABLE `membership` (
  `MembershipId` bigint(20) NOT NULL,
  `SubmissionId` bigint(20) NOT NULL,
  `MName` varchar(50) NOT NULL,
  `MClass` varchar(50) NOT NULL,
  `MPosition` varchar(50) NOT NULL,
  `MLevel` varchar(50) NOT NULL,
  `MAddress` varchar(50) NOT NULL,
  `MDateFrom` date NOT NULL,
  `MDateTo` date NOT NULL,
  `MFilename` varchar(100) NOT NULL,
  `MTempName` varchar(100) NOT NULL,
  `RevStat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `membership`
--

INSERT INTO `membership` (`MembershipId`, `SubmissionId`, `MName`, `MClass`, `MPosition`, `MLevel`, `MAddress`, `MDateFrom`, `MDateTo`, `MFilename`, `MTempName`, `RevStat`) VALUES
(1, 14, 'zuck', 'Scientific', 'National', 'Provincial/City/Municipal', 'somewhere', '2024-11-14', '2023-02-14', 'GUI docu.docx', '8561-GUI docu.docx', 1),
(2, 14, 'org', 'Honor', 'high', 'Regional', 'earth', '2021-01-17', '2021-12-12', 'Group 9 week 4 Prototype Progress.docx', '5493-Group 9 week 4 Prototype Progress.docx', 0),
(3, 14, 'Aimers Crops and Goods', 'Scientific', 'leader', 'Regional', 'address of membership', '2021-01-29', '2021-02-12', 'Capstone-Evaluation-Sheet Group 9.docx', '6108-Capstone-Evaluation-Sheet Group 9.docx', 0),
(4, 30, '1st for john', 'Honor', 'd', 'International', 'd', '2021-11-11', '2024-10-15', 'Atanque Juhn Emmanuel F BSIT 4-4 Gawain 2 October 31,2021.pdf', '5764-Atanque Juhn Emmanuel F BSIT 4-4 Gawain 2 October 31,2021.pdf', 0),
(5, 30, '2nd for john', 'Learned', 'd', 'National', 'd', '2020-11-13', '2025-08-17', 'Activity 2.docx', '1610-Activity 2.docx', 0),
(6, 30, '3rd for john', 'Honor', 'd', 'International', 'd', '2021-11-14', '2024-11-15', 'FINAL-Capstone-Documentation-Chapter-1-5 9.docx', '2787-FINAL-Capstone-Documentation-Chapter-1-5 9.docx', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ongoingstudy`
--

CREATE TABLE `ongoingstudy` (
  `OngoingId` bigint(20) NOT NULL,
  `SubmissionId` bigint(20) NOT NULL,
  `Deg` varchar(50) NOT NULL,
  `SchoolName` varchar(50) NOT NULL,
  `SchoolLevel` varchar(50) NOT NULL,
  `SupportType` varchar(50) NOT NULL,
  `SponsorName` varchar(50) NOT NULL,
  `Amount` varchar(50) NOT NULL,
  `OngoingFrom` date NOT NULL,
  `OngoingTo` date NOT NULL,
  `OngoingStatus` varchar(50) NOT NULL,
  `NumUnits` int(11) NOT NULL,
  `NumEnrolled` int(11) NOT NULL,
  `OngoingFilename` varchar(100) NOT NULL,
  `OngoingTempName` varchar(100) NOT NULL,
  `RevStat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ongoingstudy`
--

INSERT INTO `ongoingstudy` (`OngoingId`, `SubmissionId`, `Deg`, `SchoolName`, `SchoolLevel`, `SupportType`, `SponsorName`, `Amount`, `OngoingFrom`, `OngoingTo`, `OngoingStatus`, `NumUnits`, `NumEnrolled`, `OngoingFilename`, `OngoingTempName`, `RevStat`) VALUES
(1, 14, 'Doctor', 'Polytecnic University of the Philippines', 'Level II', 'Tuition Fee Discount', 'Agents', '1322.00', '2021-07-12', '2024-10-13', 'Passed Comprehensive Exam', 3, 5, '3.3 to 3.5.docx', '2352-3.3 to 3.5.docx', 1),
(2, 30, 'Docasd', 'PUP', 'Level II', 'Scholarship', 'orgsss', '12,000', '2026-12-03', '2026-02-15', 'Currently Enrolled(Old Student)', 2, 3, 'Atanque, Juhn Emmanuel F. BSIT 3-4 Activity 3.pdf', '1512-Atanque, Juhn Emmanuel F. BSIT 3-4 Activity 3.pdf', 0),
(3, 33, 'Masters', 'school', 'Level I', 'Tuition Fee Discount', 'Spons', '21,000', '2021-09-14', '2021-10-14', 'Leave of Absence', 23, 12, 'data dictionary.docx', '7142-data dictionary.docx', 0),
(4, 34, 'Engineer', 'PUP', 'Level II', 'Scholarship', 'spons', '12,000', '2021-11-14', '2021-12-12', 'Currently Enrolled(Old Student)', 3, 4, 'Capstone-Evaluation-Sheet Group 9 Prof Ran Montaril.docx', '7829-Capstone-Evaluation-Sheet Group 9 Prof Ran Montaril.docx', 0),
(5, 35, 'Doctors', 'PUP', 'Top 1000 University Ranking', 'Scholarship', 'spons', '12,000', '2021-11-13', '2022-11-11', 'Currently Enrolled for Thesis Writing', 6, 7, '3.3 to 3.5.docx', '9759-3.3 to 3.5.docx', 0),
(6, 36, 'Doctors', 'PUP', 'Level IV', 'Tuition Fee Discount', 'Spons', '20,000', '2021-12-12', '2021-11-12', 'Currently Enrolled(Old Student)', 34, 12, '3.3 to 3.5.docx', '6313-3.3 to 3.5.docx', 0),
(7, 37, 'Doctor', 'PUP', 'COE', 'Tuition Fee Discount', 'spons', '12,000', '2021-01-11', '2022-04-10', 'Currently Enrolled(Old Student)', 34, 12, 'Activity 2.docx', '3531-Activity 2.docx', 0),
(8, 38, 'Doctor', 'Polytechnic University of the Philippines', 'Level II', 'Scholarship', 'Sponsor', '23,000', '2020-07-12', '2020-12-13', 'Currently Enrolled(Old Student)', 3, 4, 'Atanque, Juhn Emmanuel F. IAS 2 Activity 1.pdf', '5839-Atanque, Juhn Emmanuel F. IAS 2 Activity 1.pdf', 1),
(9, 58, 'Doctor ', 'PUP', 'COE', 'Scholarship', 'Sponsors', '23,000', '2021-12-12', '2022-04-13', 'Currently Enrolled(Old Student)', 2, 3, 'Atanque Juhn Emmanuel F BSIT 4-4 Gawain 5 Nov 26,2021.docx', '3257-Atanque Juhn Emmanuel F BSIT 4-4 Gawain 5 Nov 26,2021.docx', 0),
(10, 60, 'Doctor', 'Polytechnic University of the philippines', 'Level I', 'Scholarship', 'Card Bank', '12300.00', '2021-12-08', '2021-12-30', 'Currently Enrolled(Old Student)', 4, 2, '8181-Atanque, Juhn Emmanuel F. BSIT 3-4 Activity 1.docx', '7221-8181-Atanque, Juhn Emmanuel F. BSIT 3-4 Activity 1.docx', 0),
(11, 61, 'Accounting', 'PUP', 'COE', 'Scholarship', 'Card Bank', '23000.00', '2021-12-02', '2022-11-16', 'Currently Enrolled(Old Student)', 3, 4, '8181-Atanque, Juhn Emmanuel F. BSIT 3-4 Activity 1.docx', '6524-8181-Atanque, Juhn Emmanuel F. BSIT 3-4 Activity 1.docx', 0),
(12, 62, 'Doctor', 'pup', 'Level I', 'Scholarship', 'card bank', '3000', '2021-12-31', '2022-11-17', 'Currently Enrolled(New Student)', 1, 2, 'Citation Research Titles.xls', '8997-Citation Research Titles.xls', 0);

-- --------------------------------------------------------

--
-- Table structure for table `opcr`
--

CREATE TABLE `opcr` (
  `OpId` bigint(20) NOT NULL,
  `SubmissionId` bigint(20) NOT NULL,
  `OpOutput` varchar(50) NOT NULL,
  `OpTargetDate` date NOT NULL,
  `OpActualDate` date NOT NULL,
  `OpDesc` varchar(50) NOT NULL,
  `OpStatus` varchar(50) NOT NULL,
  `OpRemarks` varchar(50) NOT NULL,
  `OpFilename` varchar(100) NOT NULL,
  `OpTempName` varchar(100) NOT NULL,
  `RevStat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `opcr`
--

INSERT INTO `opcr` (`OpId`, `SubmissionId`, `OpOutput`, `OpTargetDate`, `OpActualDate`, `OpDesc`, `OpStatus`, `OpRemarks`, `OpFilename`, `OpTempName`, `RevStat`) VALUES
(1, 14, 'Project', '2021-02-16', '2023-11-14', 'Good', 'Completed', 'good', 'Atanque, Juhn Emmanuel F. BSIT 3-4 Activity 1.pdf', '9661-Atanque, Juhn Emmanuel F. BSIT 3-4 Activity 1.pdf', 0),
(2, 14, 'program', '2021-01-30', '2039-04-30', 'not bad', 'Ongoing', 'still not enough', 'progress.docx', '9564-progress.docx', 0),
(3, 14, 'another one', '2021-01-15', '2024-02-14', 'sdfs', 'Ongoing', 'sdf', 'Atanque, Juhn Emmanuel F. BSIT 3-4 Activity 1.docx', '8833-Atanque, Juhn Emmanuel F. BSIT 3-4 Activity 1.docx', 0),
(4, 14, '4th title', '2021-03-29', '2039-03-30', 'sdf', 'sdf', 'sff', 'Research data.docx', '2622-Research data.docx', 0),
(5, 14, '5th Outputer', '2021-01-30', '2024-02-12', 'Cool', 'Completed', 'fast', 'tables involved.docx', '7334-tables involved.docx', 1),
(6, 14, 'Achievement in opcr', '2021-01-16', '2023-11-14', 'Brief info is included on the submitted file', 'Ongoing', 'yes', 'Research data.docx', '1168-Research data.docx', 0);

-- --------------------------------------------------------

--
-- Table structure for table `opcre`
--

CREATE TABLE `opcre` (
  `OeId` bigint(20) NOT NULL,
  `SubmissionId` bigint(20) NOT NULL,
  `OeOutput` varchar(50) NOT NULL,
  `OeTargetDate` date NOT NULL,
  `OeActualDate` date NOT NULL,
  `OeDesc` varchar(50) NOT NULL,
  `OeStatus` varchar(50) NOT NULL,
  `OeRemarks` varchar(50) NOT NULL,
  `OeFilename` varchar(100) NOT NULL,
  `OeTempName` varchar(100) NOT NULL,
  `RevStat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `opcre`
--

INSERT INTO `opcre` (`OeId`, `SubmissionId`, `OeOutput`, `OeTargetDate`, `OeActualDate`, `OeDesc`, `OeStatus`, `OeRemarks`, `OeFilename`, `OeTempName`, `RevStat`) VALUES
(1, 14, 'speeder', '2021-08-13', '2037-04-29', 'quickd', 'Deferred', 'yes', 'The LIST.docx', '2977-The LIST.docx', 1),
(2, 14, 'Accomplishment measured by efficiency', '2021-11-13', '2023-12-13', 'delayed due to personal issues', 'Deferred', 'currently being solved', 'Atanque Juhn Emmanuel F BSIT 4-4 Gawain 2 October 31,2021.docx', '9687-Atanque Juhn Emmanuel F BSIT 4-4 Gawain 2 October 31,2021.docx', 0);

-- --------------------------------------------------------

--
-- Table structure for table `opcrt`
--

CREATE TABLE `opcrt` (
  `OtId` bigint(20) NOT NULL,
  `SubmissionId` bigint(20) NOT NULL,
  `OtOutput` varchar(50) NOT NULL,
  `OtTargetDate` date NOT NULL,
  `OtActualDate` date NOT NULL,
  `OtDesc` varchar(50) NOT NULL,
  `OtStatus` varchar(50) NOT NULL,
  `OtRemarks` varchar(50) NOT NULL,
  `OtFilename` varchar(100) NOT NULL,
  `OtTempName` varchar(100) NOT NULL,
  `RevStat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `opcrt`
--

INSERT INTO `opcrt` (`OtId`, `SubmissionId`, `OtOutput`, `OtTargetDate`, `OtActualDate`, `OtDesc`, `OtStatus`, `OtRemarks`, `OtFilename`, `OtTempName`, `RevStat`) VALUES
(1, 14, 'output', '2020-02-15', '2022-10-13', 'cool', 'Ongoing', 'nice', 'progress.docx', '7420-progress.docx', 0),
(2, 14, '2nd Output', '2021-01-31', '2025-01-14', 'yes', 'Completed', 'No', 'tables involved.docx', '8737-tables involved.docx', 1),
(3, 14, 'Accomplishment measured by timeliness', '2021-11-15', '2023-11-12', 'Brief and on point', 'Ongoing', 'Currently being processed', 'FINAL-Capstone-Documentation-Chapter-1-5 9.docx', '1089-FINAL-Capstone-Documentation-Chapter-1-5 9.docx', 0);

-- --------------------------------------------------------

--
-- Table structure for table `partnership`
--

CREATE TABLE `partnership` (
  `PartnershipId` bigint(20) NOT NULL,
  `SubmissionId` bigint(20) NOT NULL,
  `PartnershipTitle` varchar(100) NOT NULL,
  `PartnershipType` varchar(100) NOT NULL,
  `PartnershipNature` varchar(100) NOT NULL,
  `PartnershipDeliverable` varchar(100) NOT NULL,
  `PartnershipBeneficiaries` varchar(100) NOT NULL,
  `PartnershipLevel` varchar(100) NOT NULL,
  `PartnershipDateFrom` date NOT NULL,
  `PartnershipDateTo` date NOT NULL,
  `PartnershipContact` varchar(100) NOT NULL,
  `PartnershipTel` varchar(100) NOT NULL,
  `PartnershipAddress` varchar(100) NOT NULL,
  `PartnershipFilename` varchar(100) NOT NULL,
  `PartnershipTempName` varchar(100) NOT NULL,
  `RevStat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `partnership`
--

INSERT INTO `partnership` (`PartnershipId`, `SubmissionId`, `PartnershipTitle`, `PartnershipType`, `PartnershipNature`, `PartnershipDeliverable`, `PartnershipBeneficiaries`, `PartnershipLevel`, `PartnershipDateFrom`, `PartnershipDateTo`, `PartnershipContact`, `PartnershipTel`, `PartnershipAddress`, `PartnershipFilename`, `PartnershipTempName`, `RevStat`) VALUES
(1, 14, 'link 1', 'Resource Speaker', 'BPO', 'Technology Transfer', 'Employee', 'National', '2021-12-12', '2022-12-12', 'ma boi', '02222222', 'sdfsd', 'progress.docx', '8690-progress.docx', 1),
(2, 14, '2nd title', 'Facilitator', 'Educational Institution', 'Training/Instruction conducted', 'Employee', 'Regional', '2021-02-13', '2021-12-15', 'yes', '2131', 'Sta. Mesa', '3.3 to 3.5.docx', '6426-3.3 to 3.5.docx', 0);

-- --------------------------------------------------------

--
-- Table structure for table `quality_rate`
--

CREATE TABLE `quality_rate` (
  `qId` bigint(20) NOT NULL,
  `EpId` bigint(20) NOT NULL,
  `QRPoor` varchar(50) NOT NULL,
  `QRFair` varchar(50) NOT NULL,
  `QRSatisfactory` varchar(50) NOT NULL,
  `QRVery` varchar(50) NOT NULL,
  `QROutstanding` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quality_rate`
--

INSERT INTO `quality_rate` (`qId`, `EpId`, `QRPoor`, `QRFair`, `QRSatisfactory`, `QRVery`, `QROutstanding`) VALUES
(1, 1, '1', '2', '3', '4', '5'),
(2, 2, '25', '10', '5', '8', '2');

-- --------------------------------------------------------

--
-- Table structure for table `quarter`
--

CREATE TABLE `quarter` (
  `QuarterId` bigint(11) NOT NULL,
  `QuarterPart` varchar(50) NOT NULL,
  `QuarterStart` date NOT NULL,
  `QuarterEnd` date NOT NULL,
  `QuarterProgress` varchar(50) NOT NULL,
  `YearId` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quarter`
--

INSERT INTO `quarter` (`QuarterId`, `QuarterPart`, `QuarterStart`, `QuarterEnd`, `QuarterProgress`, `YearId`) VALUES
(1, 'First Quarter', '2018-01-01', '2018-03-31', 'Finished', 4),
(2, 'Second Quarter', '2018-04-01', '2018-06-30', 'Finished', 4),
(3, 'Third Quarter', '2018-07-01', '2018-09-30', 'Finished', 4),
(4, 'Fourth Quarter', '2018-10-01', '2018-12-31', 'Finished', 4),
(5, 'First Quarter', '2019-01-01', '2019-03-31', 'Finished', 3),
(6, 'Second Quarter', '2019-04-01', '2019-06-30', 'Finished', 3),
(7, 'Third Quarter', '2019-07-01', '2019-09-30', 'Finished', 3),
(8, 'Fourth Quarter', '2019-10-01', '2019-12-31', 'Finished', 3),
(9, 'First Quarter', '2020-01-01', '2020-03-31', 'Finished', 1),
(10, 'Second Quarter', '2020-03-01', '2020-05-31', 'Finished', 1),
(11, 'Third Quarter', '2020-06-01', '2020-07-31', 'Finished', 1),
(12, 'Fourth Quarter', '2020-08-01', '2020-12-10', 'Finished', 1),
(13, 'First Quarter', '2021-01-01', '2021-03-31', 'Finished', 2),
(14, 'Second Quarter', '2021-04-01', '2021-06-30', 'Finished', 2),
(15, 'Third Quarter', '2021-07-01', '2021-09-30', 'Finished', 2),
(16, 'Fourth Quarter', '2021-10-01', '2021-12-31', 'Finished', 2),
(2124, 'First Quarter', '2022-01-03', '2022-03-31', 'Ongoing', 5);

-- --------------------------------------------------------

--
-- Table structure for table `rc_keywords`
--

CREATE TABLE `rc_keywords` (
  `RcKeywordId` bigint(20) NOT NULL,
  `CitationId` bigint(20) NOT NULL,
  `RcKeyword` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rc_keywords`
--

INSERT INTO `rc_keywords` (`RcKeywordId`, `CitationId`, `RcKeyword`) VALUES
(46, 1, 'word'),
(47, 1, 'wrod'),
(48, 1, 'wrdo'),
(49, 1, 'drow'),
(50, 1, 'rowd'),
(51, 3, 't'),
(52, 3, 'h'),
(53, 3, 'i'),
(54, 3, 's'),
(55, 3, 'e'),
(56, 2, 'no'),
(57, 2, 'noo'),
(58, 2, 'nooo'),
(59, 2, 'noooo'),
(60, 2, 'nooooot'),
(76, 5, 'qwer'),
(77, 5, 'asd'),
(78, 5, 'zxc'),
(79, 5, 'tyu'),
(80, 5, 'fgh'),
(81, 6, 'Arbitrage'),
(82, 6, 'Profit'),
(83, 6, 'Future'),
(84, 6, 'Markets'),
(85, 6, 'Commodity'),
(86, 7, 'Maternal'),
(87, 7, 'Morality'),
(88, 7, 'National'),
(89, 7, 'Scale'),
(90, 7, 'Health'),
(91, 0, 'NCLB'),
(92, 0, 'Curriculum'),
(93, 0, 'Teachers'),
(94, 0, 'Profession'),
(95, 0, 'Standards'),
(101, 4, 'one'),
(102, 4, 'two'),
(103, 4, 'three'),
(104, 4, 'four'),
(105, 4, 'five');

-- --------------------------------------------------------

--
-- Table structure for table `rc_name`
--

CREATE TABLE `rc_name` (
  `RcNameId` bigint(20) NOT NULL,
  `CitationId` bigint(20) NOT NULL,
  `RcName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rc_name`
--

INSERT INTO `rc_name` (`RcNameId`, `CitationId`, `RcName`) VALUES
(20, 1, 'Karen stephan'),
(21, 1, 'Giorno Giovani'),
(22, 3, 'Thomas Thomas'),
(23, 2, 'Dan Daniels'),
(24, 2, 'Carl Marks'),
(25, 2, 'David Davidson'),
(32, 5, 'Giorno Giovani'),
(33, 6, 'Giorno Giovani'),
(34, 7, 'Giorno Giovani'),
(35, 7, 'Carl Carlson'),
(36, 0, 'James Jameson'),
(37, 0, 'David Davidson'),
(38, 0, 'Karen stephan'),
(41, 4, 'Giorno Giovani'),
(42, 4, 'Charlie Kaufman');

-- --------------------------------------------------------

--
-- Table structure for table `relationprogram`
--

CREATE TABLE `relationprogram` (
  `RapId` bigint(20) NOT NULL,
  `SubmissionId` bigint(20) NOT NULL,
  `RapTitle` varchar(100) NOT NULL,
  `RapPlace` varchar(100) NOT NULL,
  `RapDate` date NOT NULL,
  `RapLevel` varchar(100) NOT NULL,
  `RapFilename` varchar(100) NOT NULL,
  `RapTempName` varchar(100) NOT NULL,
  `RevStat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `relationprogram`
--

INSERT INTO `relationprogram` (`RapId`, `SubmissionId`, `RapTitle`, `RapPlace`, `RapDate`, `RapLevel`, `RapFilename`, `RapTempName`, `RevStat`) VALUES
(1, 14, '1st program title', '1st place', '2021-01-31', 'International', 'GUI docu.docx', '4796-GUI docu.docx', 0),
(2, 14, '2nd title', '2nd place', '2021-11-12', 'Regional', 'GUI docu.docx', '8354-GUI docu.docx', 1),
(3, 14, 'Community Relation Implemented', 'Sta. Mesa', '2021-01-14', 'National', 'Atanque, Juhn Emmanuel F. BSIT 3-4.pdf', '9508-Atanque, Juhn Emmanuel F. BSIT 3-4.pdf', 0),
(4, 30, 'f', 'p', '2021-11-14', 'National', 'Capstone-Evaluation-Sheet Group 9 Prof Ria Sagum.docx', '8755-Capstone-Evaluation-Sheet Group 9 Prof Ria Sagum.docx', 0),
(5, 33, 'prog', 'yes', '2021-01-30', 'International', 'Atanque, Juhn Emmanuel F. BSIT 3-4 Activity 4.docx', '6816-Atanque, Juhn Emmanuel F. BSIT 3-4 Activity 4.docx', 0),
(6, 58, 'Title', 'PUP', '2020-03-02', 'International', 'Atanque Juhn Emmanuel F BSIT 4-4 Gawain 2 October 31,2021.docx', '4763-Atanque Juhn Emmanuel F BSIT 4-4 Gawain 2 October 31,2021.docx', 0);

-- --------------------------------------------------------

--
-- Table structure for table `reqandque`
--

CREATE TABLE `reqandque` (
  `ReqId` int(11) NOT NULL,
  `SubmissionId` int(11) NOT NULL,
  `ReqActed` varchar(50) NOT NULL,
  `ReqDesc` varchar(50) NOT NULL,
  `ReqAverageTime` varchar(50) NOT NULL,
  `ReqCategory` varchar(50) NOT NULL,
  `ReqFilename` varchar(100) NOT NULL,
  `ReqTempName` varchar(100) NOT NULL,
  `RevStat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reqandque`
--

INSERT INTO `reqandque` (`ReqId`, `SubmissionId`, `ReqActed`, `ReqDesc`, `ReqAverageTime`, `ReqCategory`, `ReqFilename`, `ReqTempName`, `RevStat`) VALUES
(1, 14, '4', 'fast', '6', 'good', 'data dictionary.docx', '6999-data dictionary.docx', 1),
(2, 14, '4', 'faster', '6', 'good', 'Capstone-Evaluation-Sheet Group 9 Prof Juancho Espineli.pdf', '7553-Capstone-Evaluation-Sheet Group 9 Prof Juancho Espineli.pdf', 0),
(3, 14, '4', 'faster', '6', 'gooder', 'Activity 2.docx', '7466-Activity 2.docx', 0),
(4, 14, '4', 'different', '9', 'good', 'FINAL-Capstone-Documentation-Chapter-1-5 9.docx', '9604-FINAL-Capstone-Documentation-Chapter-1-5 9.docx', 0),
(5, 14, '45', 'Evaluation', '1', 'Office', 'Capstone-Evaluation-Sheet Group 9 Prof Juancho Espineli.docx', '2964-Capstone-Evaluation-Sheet Group 9 Prof Juancho Espineli.docx', 0),
(6, 14, '4', 'All are records submitted ', '3', 'requests acted upon', 'GUI docu.docx', '5813-GUI docu.docx', 0);

-- --------------------------------------------------------

--
-- Table structure for table `researchcitation`
--

CREATE TABLE `researchcitation` (
  `CitationId` bigint(20) NOT NULL,
  `SubmissionId` bigint(20) NOT NULL,
  `RcClass` varchar(100) NOT NULL,
  `RcCategory` varchar(100) NOT NULL,
  `RcAgenda` varchar(100) NOT NULL,
  `RcTitle` varchar(100) NOT NULL,
  `RcInvolve` varchar(100) NOT NULL,
  `RcType` varchar(100) NOT NULL,
  `RcFundType` varchar(100) NOT NULL,
  `RcFundAmount` varchar(100) NOT NULL,
  `RcFundAgency` varchar(100) NOT NULL,
  `RcDateStart` date NOT NULL,
  `RcDateTarget` date NOT NULL,
  `RcDateCompleted` date NOT NULL,
  `RcArticleCited` varchar(100) NOT NULL,
  `RcResearchCitedBy` varchar(100) NOT NULL,
  `RcAuthorsCitedBy` varchar(100) NOT NULL,
  `RcJournalsCitedBy` varchar(100) NOT NULL,
  `RcVolNo` varchar(100) NOT NULL,
  `RcJournalIssue` varchar(100) NOT NULL,
  `RcJournalPage` varchar(100) NOT NULL,
  `RcJournalYear` varchar(100) NOT NULL,
  `RcJournalPublisher` varchar(100) NOT NULL,
  `RcJournalIndexing` varchar(100) NOT NULL,
  `RcFilename` varchar(100) NOT NULL,
  `RcTempName` varchar(100) NOT NULL,
  `RevStat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `researchcitation`
--

INSERT INTO `researchcitation` (`CitationId`, `SubmissionId`, `RcClass`, `RcCategory`, `RcAgenda`, `RcTitle`, `RcInvolve`, `RcType`, `RcFundType`, `RcFundAmount`, `RcFundAgency`, `RcDateStart`, `RcDateTarget`, `RcDateCompleted`, `RcArticleCited`, `RcResearchCitedBy`, `RcAuthorsCitedBy`, `RcJournalsCitedBy`, `RcVolNo`, `RcJournalIssue`, `RcJournalPage`, `RcJournalYear`, `RcJournalPublisher`, `RcJournalIndexing`, `RcFilename`, `RcTempName`, `RevStat`) VALUES
(1, 14, 'Project', 'Research', 'Peace and Security', 'Research Citation Example', 'Lead Researcher', 'Applied Research (Diversity and Incluvisity Related)', 'Self Funded', '456.00', 'Company', '2021-02-13', '2021-11-12', '2040-01-29', 'Research Title', 'Article Title', 'Author Who Cited', 'Title of Books', 'Vol No. 10', 'Issue 10', 'Page 35-38', '2021', 'Publisher', 'ASEAN Citation Index', 'from dictionary to requirements.pptx', '2933-from dictionary to requirements.pptx', 0),
(2, 14, 'Study', 'Book Chapter', 'Peace and Security', 'Another Citation', 'Co-Lead Researcher', 'Basic Research (GAD Related)', 'University Funded', '3434', 'Funders', '2020-02-12', '2020-02-13', '2022-12-31', 'Title', 'Research Article', 'Author of Article', 'Title of  Research Journal', 'Vol No 30', 'Issue No 12', 'Page No 90- 102', '2021', 'Publishers', 'Web of Science', 'style.css', '4257-style.css', 1),
(3, 14, 'Project', 'Book Chapter', 'Accelerating Infrastructure Development through Science and Technology', 'Cited', 'Lead Researcher', 'Applied Research ', 'University Funded', '3333', 'asdf', '2021-01-31', '2020-01-12', '2021-01-15', 'd', 'e', 'd', 'v', 'ed', 'e', 'q', 's', 'q', 'Web of Science', 'Atanque, Juhn Emmanuel F. BSIT 3-4 Activity 1.pdf', '3812-Atanque, Juhn Emmanuel F. BSIT 3-4 Activity 1.pdf', 0),
(4, 14, 'Project', 'Book Chapter', 'Peace and Security', 'Cool Research Title', 'Co-Lead Researcher', 'Applied Research ', 'Externally Funded', '23000', 'funders', '2020-01-30', '2021-01-14', '2021-01-13', 'yes', 'Book Title', 'Book Author', 'Journal Title', 'Vol No. 12', '132', '14-55', '2021', 'Publishers Co.', 'CHED Recognized Journals', 'The LIST.docx', '1180-The LIST.docx', 0),
(5, 33, 'Program', 'Book Chapter', 'Poverty Reduction', 'Cited research in CL', 'Independent Researcher', 'Applied Research ', 'University Funded', '20,111', 'funders', '2021-11-13', '2017-12-11', '2024-11-14', 'tie', 'Research times', 'Mr. Author', 'journal', '34', '32', '12-34', '2021', 'Publishers', 'International Refereed Journals', 'Research data.docx', '8922-Research data.docx', 0),
(6, 38, 'Study', 'Research', 'Accelerating Infrastructure Development through Science and Technology', 'Statistical Arbitrage Strategies and Profit Potential in Commodity Futures Markets', 'Co-Lead Researcher', 'Creative Work ', 'Self Funded', '15,000', 'N/A', '2020-01-01', '2020-08-05', '2020-08-02', 'Future Market Analysis', 'Market Breakdown', 'John Dwight', 'Market statistics', 'Vol no.4', '45', '12-43', '2020', 'Publish Co.', 'Excellence in Research for Australia', 'Activity 2.docx', '1177-Activity 2.docx', 0),
(7, 43, 'Project', 'Book Chapter', 'Protection and Rehabilitation towards Sustainable Development', 'Delivering Maternal Health: An Examination of Maternal Mortality on a National Scale', 'Independent Researcher', 'Applied Research ', 'Externally Funded', '29,000', 'UN Alliance', '2018-05-05', '2018-06-05', '2018-05-21', 'Delivering Maternal Health: An Examination of Maternal Mortality on a National Scale', 'Delivering Maternal Health:', 'Carl Borweign', 'Global Times', '42', '9', '23-57', '2018', 'Publish Co.', 'International Refereed Journals', 'The LIST.docx', '3823-The LIST.docx', 0);

-- --------------------------------------------------------

--
-- Table structure for table `researchongoing`
--

CREATE TABLE `researchongoing` (
  `RoId` bigint(20) NOT NULL,
  `SubmissionId` bigint(20) NOT NULL,
  `RoClass` varchar(100) NOT NULL,
  `RoCategory` varchar(100) NOT NULL,
  `RoAgenda` varchar(100) NOT NULL,
  `RoTitle` varchar(100) NOT NULL,
  `RoInvolve` varchar(100) NOT NULL,
  `RoType` varchar(100) NOT NULL,
  `RoFundType` varchar(100) NOT NULL,
  `RoFundAmount` varchar(100) NOT NULL,
  `RoFundAgency` varchar(100) NOT NULL,
  `RoDateStart` date NOT NULL,
  `RoDateTarget` date NOT NULL,
  `RoStatus` varchar(50) NOT NULL,
  `RoDateCompleted` date NOT NULL,
  `RoFilename` varchar(100) NOT NULL,
  `RoTempName` varchar(100) NOT NULL,
  `RevStat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `researchongoing`
--

INSERT INTO `researchongoing` (`RoId`, `SubmissionId`, `RoClass`, `RoCategory`, `RoAgenda`, `RoTitle`, `RoInvolve`, `RoType`, `RoFundType`, `RoFundAmount`, `RoFundAgency`, `RoDateStart`, `RoDateTarget`, `RoStatus`, `RoDateCompleted`, `RoFilename`, `RoTempName`, `RevStat`) VALUES
(1, 14, 'Program', 'Book Chapter', 'Peace and Security', 'Cool Research Title', 'Lead Researcher', 'Applied Research ', 'Externally Funded', '50', 'Card Bank', '2021-01-12', '2021-01-13', 'Ongoing', '0000-00-00', 'Cool Research Title', '6748-Atanque, Juhn Emmanuel F. BSIT 3-4 Activity 2.pdf', 0),
(2, 14, 'Study', 'Book Chapter', 'Accelerating Infrastructure Development through Science and Technology', 'another research title', 'Independent Researcher', 'Applied Research ', 'University Funded', '50,000', 'THE funding agency', '2021-01-14', '2040-11-14', 'Completed', '2022-11-14', 'Another Cool Research', '9732-progress.docx', 0),
(3, 14, 'Program', 'Book Chapter', 'Protection and Rehabilitation towards Sustainable Development', 'New research title', 'Lead Researcher', 'Creative Work ', 'Self Funded', '6000', 'Parents', '2019-02-14', '2021-04-14', 'Deferred', '2022-11-14', 'GUI docu.docx', '9805-GUI docu.docx', 0),
(4, 14, 'Project', 'Book Chapter', 'Poverty Reduction', 'Serious Research', 'Lead Researcher', 'Creative Work ', 'Self Funded', '2323', 'Home', '2021-01-14', '2022-11-14', 'Ongoing', '2024-01-11', 'Capstone-Evaluation-Sheet Group 9 Mam Ria Sagum.pdf', '5291-Capstone-Evaluation-Sheet Group 9 Mam Ria Sagum.pdf', 0),
(5, 14, 'Program', 'Research', 'Poverty Reduction', 'Its another one', 'Independent Researcher', 'Applied Research ', 'University Funded', '342', 'sadf', '2020-01-12', '2023-11-14', 'Ongoing', '2023-11-15', 'Activity 2.docx', '1421-Activity 2.docx', 0),
(6, 14, 'Program', 'Research', 'Poverty Reduction', 'last research', 'Lead Researcher', 'Basic Research ', 'Self Funded', '3', 'sers', '2021-03-15', '2038-01-31', 'Completed', '2024-03-13', 'The LIST.docx', '3808-The LIST.docx', 0),
(7, 14, 'Program', 'Research', 'Peace and Security', 'Title', 'Lead Researcher', 'Applied Research ', 'University Funded', '3424', 'sfa', '2021-11-13', '2024-11-14', 'Deferred', '2024-06-14', 'Activity 2.docx', '2799-Activity 2.docx', 1),
(8, 14, 'Project', 'Research', 'Peace and Security', 'one more research', 'Independent Researcher', 'Applied Research ', 'Self Funded', '23423', 'dsfsdf', '2021-02-13', '2021-02-12', 'Completed', '2021-11-11', '3.3 to 3.5.docx', '9508-3.3 to 3.5.docx', 0),
(9, 14, 'Program', 'Research', 'Peace and Security', 'Research about pressing matters', 'Independent Researcher', 'Applied Research ', 'Externally Funded', '23424242', 'Speedwagon', '2021-02-15', '2022-11-11', 'Ongoing', '0000-00-00', 'progress.docx', '2195-progress.docx', 0),
(10, 14, 'Program', 'Research', 'Poverty Reduction', 'new research completed', 'Lead Researcher', 'Basic Research ', 'Externally Funded', '2342', 'funders', '2021-12-31', '2021-12-12', 'Completed', '2022-01-11', 'Atanque, Juhn Emmanuel F. BSIT 3-4 Activity 2.pdf', '5584-Atanque, Juhn Emmanuel F. BSIT 3-4 Activity 2.pdf', 0),
(11, 14, 'Study', 'Research', 'Accelerating Infrastructure Development through Science and Technology', 'Research about pressing matters', 'Lead Researcher', 'Applied Research ', 'Self Funded', '129000.11', 'None ', '2021-01-05', '2021-12-13', 'Ongoing', '0000-00-00', 'Capstone-Evaluation-Sheet Group 9 Prof Ran Montaril.docx', '9922-Capstone-Evaluation-Sheet Group 9 Prof Ran Montaril.docx', 0),
(12, 33, 'Project', 'Book Chapter', 'Poverty Reduction', 'CL research of guy', 'Lead Researcher', 'Applied Research ', 'University Funded', '23,000', 'sdfs', '2021-10-16', '2021-12-13', 'Ongoing', '2021-11-11', 'Capstone-Evaluation-Sheet Group 9.pdf', '9001-Capstone-Evaluation-Sheet Group 9.pdf', 0),
(13, 34, 'Project', 'Research', 'Peace and Security', 'sdf', 'Lead Researcher', 'Basic Research ', 'University Funded', '23,000', 'sdf', '2021-10-13', '2021-12-12', 'Ongoing', '2021-01-13', 'Capstone-Evaluation-Sheet Group 9 Prof Juancho Espineli.pdf', '5935-Capstone-Evaluation-Sheet Group 9 Prof Juancho Espineli.pdf', 0),
(14, 37, 'Project', 'Research', 'Protection and Rehabilitation towards Sustainable Development', 'Lorenz research', 'Independent Researcher', 'Applied Research (GAD Related)', 'Externally Funded', '12,000', 'Funders', '2021-11-13', '2015-12-12', 'Completed', '2021-12-12', 'Research data.docx', '7191-Research data.docx', 0),
(15, 38, 'Program', 'Research', 'Poverty Reduction', 'Modelling CFPB Consumer Complaint Topics Using Unsupervised Learning ', 'Co-Lead Researcher', 'Creative Work ', 'University Funded', '23,000', 'Funders', '2020-02-02', '2021-12-12', 'Ongoing', '2020-12-12', '2020-CK-FOR-DICTATION-1.docx', '3612-2020-CK-FOR-DICTATION-1.docx', 0),
(16, 39, 'Project', 'Research', 'Peace and Security', 'Changes in Perceived Risk and Liquidity Shocks and Its Impact on Risk Premiums', 'Lead Researcher', 'Applied Research ', 'Self Funded', '32,000', 'N/A', '2020-04-14', '2021-02-05', 'Completed', '2020-12-07', 'Activity 2.docx', '7671-Activity 2.docx', 0),
(17, 40, 'Project', 'Book Chapter', 'Accelerating Infrastructure Development through Science and Technology', 'Overeducation: The Effects of the Great Recession on the Labor Market ', 'Independent Researcher', 'Basic Research ', 'University Funded', '4,000', 'PUP', '2018-02-14', '2018-02-24', 'Deferred', '0000-00-00', '3.3 to 3.5.docx', '6459-3.3 to 3.5.docx', 0),
(18, 44, 'Study', 'Book Chapter', 'Environmental Conservation', 'Natural or Human-Made Disaster: Dimensions of Impact Measurement', 'Lead Researcher', 'Applied Research ', 'Externally Funded', '23,000', 'ASEAN', '2018-05-04', '2018-06-12', 'Completed', '2018-06-29', 'Creating Bio.docx', '5521-Creating Bio.docx', 0),
(19, 49, 'Program', 'Research', 'Accelerating Infrastructure Development through Science and Technology', 'An Account of Worth through Corporate Communication', 'Co-Lead Researcher', 'Applied Research (GAD Related & Diversity and Incluvisity Related)', 'University Funded', '5,000', 'PUP', '2019-01-02', '2021-12-04', 'Ongoing', '0000-00-00', 'Creating Bio.docx', '8993-Creating Bio.docx', 0),
(20, 53, 'Project', 'Book Chapter', 'Peace and Security', 'The Impact of Obesity on Education', 'Lead Researcher', 'Applied Research ', 'Self Funded', '4,000', 'N/A', '2020-09-03', '2020-12-03', 'Completed', '2020-11-02', 'Atanque, Juhn Emmanuel F. BSIT 3-4 Activity 3.pdf', '1256-Atanque, Juhn Emmanuel F. BSIT 3-4 Activity 3.pdf', 0);

-- --------------------------------------------------------

--
-- Table structure for table `researchpresentation`
--

CREATE TABLE `researchpresentation` (
  `RpresId` bigint(20) NOT NULL,
  `SubmissionId` bigint(20) NOT NULL,
  `RpresClass` varchar(100) NOT NULL,
  `RpresCategory` varchar(100) NOT NULL,
  `RpresAgenda` varchar(100) NOT NULL,
  `RpresTitle` varchar(100) NOT NULL,
  `RpresInvolve` varchar(100) NOT NULL,
  `RpresType` varchar(100) NOT NULL,
  `RpresFundType` varchar(100) NOT NULL,
  `RpresFundAmount` varchar(100) NOT NULL,
  `RpresFundAgency` varchar(100) NOT NULL,
  `RpresDateStart` date NOT NULL,
  `RpresDateTarget` date NOT NULL,
  `RpresDateCompleted` date NOT NULL,
  `RpresConTitle` varchar(100) NOT NULL,
  `RpresOrganizer` varchar(100) NOT NULL,
  `RpresVenue` varchar(100) NOT NULL,
  `RpresDatePresent` date NOT NULL,
  `RpresLevel` varchar(100) NOT NULL,
  `RpresFilename` varchar(100) NOT NULL,
  `RpresTempName` varchar(100) NOT NULL,
  `RevStat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `researchpresentation`
--

INSERT INTO `researchpresentation` (`RpresId`, `SubmissionId`, `RpresClass`, `RpresCategory`, `RpresAgenda`, `RpresTitle`, `RpresInvolve`, `RpresType`, `RpresFundType`, `RpresFundAmount`, `RpresFundAgency`, `RpresDateStart`, `RpresDateTarget`, `RpresDateCompleted`, `RpresConTitle`, `RpresOrganizer`, `RpresVenue`, `RpresDatePresent`, `RpresLevel`, `RpresFilename`, `RpresTempName`, `RevStat`) VALUES
(1, 14, 'Program', 'Book Chapter', 'Peace and Security', 'Research Presented', 'Co-Lead Researcher', 'Applied Research ', 'University Funded', '2342', 'werw', '2020-01-14', '2019-11-13', '2023-11-12', 'Special Conference', 'The Organizers', 'Earth', '2023-11-12', 'National', 'tables involved.docx', '1613-tables involved.docx', 0),
(2, 14, 'Study', 'Book Chapter', 'Environmental Conservation', 'Another One Presented', 'Co-Lead Researcher', 'Creative Work ', 'Externally Funded', '5555.00', 'sdf', '2021-02-14', '2020-01-13', '2021-01-12', 'Music', 'The orgzzzzz', 'Somewhere', '2021-03-28', 'Regional', 'scriptf for def.docx', '3438-scriptf for def.docx', 0),
(3, 14, 'Study', 'Research', 'Peace and Security', 'Present', 'Associate Lead Researcher', 'Creative Work ', 'Self Funded', '45.00', 'asf', '2019-11-11', '2019-10-12', '2023-10-14', 'kon kon', 'dfsee', 'house', '2023-02-14', 'National', 'Group 9 week 4 Prototype Progress.docx', '1072-Group 9 week 4 Prototype Progress.docx', 1),
(4, 14, 'Study', 'Book Chapter', 'Accelerating Infrastructure Development through Science and Technology', 'Presentation in research ', 'Co-Lead Researcher', 'Creative Work ', 'Self Funded', '5000.00', 'Down the streets', '2021-01-14', '2019-01-13', '2021-12-13', 'Titulo', 'Mga TAO', 'LUGAR', '2023-11-12', 'Local-PUP', 'tables involved.docx', '1235-tables involved.docx', 0),
(5, 38, 'Study', 'Book Chapter', 'Accelerating Infrastructure Development through Science and Technology', 'Uncertainty in measuring Sustainable Development: An application for the Sustainability-adjusted HDI', 'Lead Researcher', 'Applied Research ', 'Self Funded', '15,000', 'N/A', '2014-02-14', '2021-12-12', '2020-03-12', 'HDI breakdown', 'PUP', 'PUP Sta. Mesa', '2020-12-20', 'Regional', 'Activity 2.docx', '8108-Activity 2.docx', 0),
(6, 41, 'Project', 'Book Chapter', 'Peace and Security', 'Spatial Summary of Outdoor Dining and COVID-19 Rates in Manila', 'Independent Researcher', 'Basic Research ', 'University Funded', '10,000', 'PUP', '2018-01-03', '2018-03-03', '2018-02-03', 'Spatial Summary of Outdoor Dining and COVID-19 Rates in Manila', 'PUP', 'PUP Sta.Mesa', '2018-03-21', 'Regional', 'Activity 2.docx', '7978-Activity 2.docx', 0),
(7, 46, 'Study', 'Research', 'Accelerating Infrastructure Development through Science and Technology', 'Couple Dissolution Between Couples Who Meet Offline Versus Couples Who Meet Offline', 'Associate Lead Researcher', 'Basic Research (GAD Related)', 'Self Funded', '1,000', 'N/A', '2019-02-03', '2019-03-02', '2019-02-25', 'Status', 'PUP', 'PUP Sta. Mesa', '2019-03-11', 'Local-PUP', 's.docx', '7669-s.docx', 0),
(8, 51, 'Program', 'Book Chapter', 'Accelerating Infrastructure Development through Science and Technology', 'Modelling CFPB Consumer Complaint Topics Using Unsupervised Learning ', 'Lead Researcher', 'Creative Work ', 'Self Funded', '4,000', 'N/A', '2019-02-03', '2020-02-04', '2020-01-01', 'Research Year Opening', 'PUP', 'PUP Sta. Mesa', '2020-01-12', 'Provincial/City/Municipal', 'Group 9 week 4 Prototype Progress.docx', '5875-Group 9 week 4 Prototype Progress.docx', 0),
(9, 52, 'Project', 'Research', 'Accelerating Infrastructure Development through Science and Technology', 'Unit Root or Mean Reversion in Stock Index: Evidence from the Philippines', 'Co-Lead Researcher', 'Basic Research (GAD Related & Diversity and Incluvisity Related)', 'Self Funded', '1,000', 'N/A', '2020-05-14', '2020-06-01', '2020-05-25', 'Stock Analysis', 'PUP', 'Sta. Mesa', '2020-05-27', 'Regional', 'Capstone-Evaluation-Sheet Group 9 Prof Ran Montaril.pdf', '8867-Capstone-Evaluation-Sheet Group 9 Prof Ran Montaril.pdf', 0);

-- --------------------------------------------------------

--
-- Table structure for table `researchpublication`
--

CREATE TABLE `researchpublication` (
  `RpId` bigint(20) NOT NULL,
  `SubmissionId` bigint(20) NOT NULL,
  `RpClass` varchar(100) NOT NULL,
  `RpCategory` varchar(100) NOT NULL,
  `RpAgenda` varchar(100) NOT NULL,
  `RpTitle` varchar(100) NOT NULL,
  `RpInvolve` varchar(100) NOT NULL,
  `RpType` varchar(100) NOT NULL,
  `RpFundType` varchar(100) NOT NULL,
  `RpFundAmount` varchar(100) NOT NULL,
  `RpFundAgency` varchar(100) NOT NULL,
  `RpDateStart` date NOT NULL,
  `RpDateTarget` date NOT NULL,
  `RpDateCompleted` date NOT NULL,
  `RpJournalName` varchar(100) NOT NULL,
  `RpPageNumber` varchar(100) NOT NULL,
  `RpVolumeNo` varchar(100) NOT NULL,
  `RpIssueNo` varchar(100) NOT NULL,
  `RpIndexingPlatform` varchar(100) NOT NULL,
  `RpDatePublished` date NOT NULL,
  `RpPublisher` varchar(100) NOT NULL,
  `RpEditor` varchar(100) NOT NULL,
  `RpISSN` varchar(100) NOT NULL,
  `RpLevel` varchar(100) NOT NULL,
  `RpFilename` varchar(100) NOT NULL,
  `RpTempName` varchar(100) NOT NULL,
  `RevStat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `researchpublication`
--

INSERT INTO `researchpublication` (`RpId`, `SubmissionId`, `RpClass`, `RpCategory`, `RpAgenda`, `RpTitle`, `RpInvolve`, `RpType`, `RpFundType`, `RpFundAmount`, `RpFundAgency`, `RpDateStart`, `RpDateTarget`, `RpDateCompleted`, `RpJournalName`, `RpPageNumber`, `RpVolumeNo`, `RpIssueNo`, `RpIndexingPlatform`, `RpDatePublished`, `RpPublisher`, `RpEditor`, `RpISSN`, `RpLevel`, `RpFilename`, `RpTempName`, `RevStat`) VALUES
(1, 14, 'Project', 'Book Chapter', 'Peace and Security', 'Published Research', 'Lead Researcher', 'Basic Research ', 'Externally Funded', '4567.00', 'The funders', '2020-03-28', '2021-01-15', '2023-02-14', 'The journal', '54', '64', '32', '65', '2023-11-14', 'The publisher', 'The Editor', 'ISSN', 'National', 'Atanque, Juhn Emmanuel F. BSIT 3-4 Activity 1.docx', '8181-Atanque, Juhn Emmanuel F. BSIT 3-4 Activity 1.docx', 0),
(2, 14, 'Study', 'Research', 'Protection and Rehabilitation towards Sustainable Development', 'Another published study', 'Lead Researcher', 'Applied Research ', 'Externally Funded', '3434343434', 'This agency again', '2021-10-13', '2021-11-15', '2024-11-16', 'The Revelation', '3', '2', '5', '2', '2022-01-13', 'ME', 'Also me', 'ISBN', 'Local-PUP', 'Atanque, Juhn Emmanuel F. BSIT 3-4 Activity 4.pdf', '6098-Atanque, Juhn Emmanuel F. BSIT 3-4 Activity 4.pdf', 1),
(3, 14, 'Program', 'Research', 'Peace and Security', 'Third publish Stuff', 'Independent Researcher', 'Applied Research ', 'University Funded', '1223', 'saf', '2021-05-12', '2021-02-13', '2021-11-13', 'j name', '3', '2', '3', '1', '2023-11-13', 'publi', 'sdf', 'ISBN', 'Local-PUP', 'progress.docx', '2745-progress.docx', 0),
(4, 14, 'Study', 'Book Chapter', 'Peace and Security', 'Titlez', 'Lead Researcher', 'Applied Research ', 'Self Funded', '4231.00', 'N/A', '2019-02-13', '2021-01-12', '2021-11-13', '', '1', '2', '3', '4', '2021-01-12', 'me', 'me', 'ISSN', 'National', 'GUI docu.docx', '5533-GUI docu.docx', 0),
(5, 30, 'Program', 'Research', 'Poverty Reduction', 'johns', 'Lead Researcher', 'Applied Research ', 'Self Funded', '29,000', 'sdf', '2021-01-30', '2021-11-12', '2021-01-14', 'sdf', 'sdf', 'ew', 'w', 'e', '2021-12-14', 'we', 'wer', 'sdf', 'National', 'Atanque, Juhn Emmanuel F. BSIT 3-4 Activity 1.pdf', '8496-Atanque, Juhn Emmanuel F. BSIT 3-4 Activity 1.pdf', 0),
(6, 34, 'Program', 'Research', 'Poverty Reduction', 'sdf', 'Lead Researcher', 'Applied Research ', 'Self Funded', '21,000', 'wer', '2021-01-30', '2021-01-30', '2021-01-15', 'wer', 'w2', '123', '21', 'asdf', '2021-01-30', '2', '1', 'w', 'National', 'Atanque Juhn Emmanuel F BSIT 4-4 Gawain 2 October 31,2021.pdf', '6665-Atanque Juhn Emmanuel F BSIT 4-4 Gawain 2 October 31,2021.pdf', 0),
(7, 35, 'Program', 'Book Chapter', 'Poverty Reduction', 'for karen', 'Independent Researcher', 'Basic Research ', 'University Funded', '45,000', 'df', '2021-01-13', '2021-12-14', '2021-12-11', 'd', 'swe', '323', '23', 'sds', '2022-12-11', 'sd', 'we', 'sd', 'sd', 'data dictionary.docx', '7126-data dictionary.docx', 0),
(8, 38, 'Study', 'Book Chapter', 'Accelerating Infrastructure Development through Science and Technology', 'Social Capital’s Role in Accessing PPP Funds & the Evolving Nature of Online Lenders in the Small Bu', 'Independent Researcher', 'Applied Research ', 'Self Funded', '20,000', 'N/A', '2012-12-12', '2022-01-02', '2021-08-13', '', '23-21', '7', '5', 'N/A', '2020-09-24', 'Publish Co.', 'Publish Co.', 'ISSN', 'National', 'Activity 2.docx', '2827-Activity 2.docx', 0),
(9, 45, 'Project', 'Research', ' Competitive Industry and Entrepreneurship', 'The determinants of Party and Coalition Identification in the Philippines: The effect of long and sh', 'Independent Researcher', 'Basic Research ', 'Externally Funded', '24,000', 'PhilGov', '2018-08-02', '2018-12-12', '2018-11-15', '', '32-34', '1', '3', 'N/A', '2018-11-25', 'Pub', 'Pub Co.', 'ISSN', 'International', 'Atanque, Juhn Emmanuel F. BSIT 3-4.pdf', '2695-Atanque, Juhn Emmanuel F. BSIT 3-4.pdf', 0),
(10, 54, 'Study', 'Book Chapter', 'Protection and Rehabilitation towards Sustainable Development', 'Path Towards an Attainable Future: The Effect of College Access Programs on High School Dropout', 'Lead Researcher', 'Applied Research ', 'University Funded', '14,000', 'PUP', '2020-02-02', '2021-02-04', '2020-10-11', '', '4', '1', '2', 'N/A', '2020-11-21', 'Publish Co.', 'Editor Inc.', 'ISBN', 'Regional', 'd.txt', '6086-d.txt', 0);

-- --------------------------------------------------------

--
-- Table structure for table `researchutilization`
--

CREATE TABLE `researchutilization` (
  `UtiId` bigint(20) NOT NULL,
  `SubmissionId` bigint(20) NOT NULL,
  `RuClass` varchar(100) NOT NULL,
  `RuCategory` varchar(100) NOT NULL,
  `RuAgenda` varchar(100) NOT NULL,
  `RuTitle` varchar(100) NOT NULL,
  `RuInvolve` varchar(100) NOT NULL,
  `RuType` varchar(100) NOT NULL,
  `RuFundType` varchar(100) NOT NULL,
  `RuFundAmount` varchar(100) NOT NULL,
  `RuFundAgency` varchar(100) NOT NULL,
  `RuDateStart` date NOT NULL,
  `RuDateTarget` date NOT NULL,
  `RuDateCompleted` date NOT NULL,
  `RuAgency` varchar(100) NOT NULL,
  `RuDesc` varchar(100) NOT NULL,
  `RuLevel` varchar(100) NOT NULL,
  `RuFilename` varchar(100) NOT NULL,
  `RuTempName` varchar(100) NOT NULL,
  `RevStat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `researchutilization`
--

INSERT INTO `researchutilization` (`UtiId`, `SubmissionId`, `RuClass`, `RuCategory`, `RuAgenda`, `RuTitle`, `RuInvolve`, `RuType`, `RuFundType`, `RuFundAmount`, `RuFundAgency`, `RuDateStart`, `RuDateTarget`, `RuDateCompleted`, `RuAgency`, `RuDesc`, `RuLevel`, `RuFilename`, `RuTempName`, `RevStat`) VALUES
(1, 14, 'Study', 'Book Chapter', 'Environmental Conservation', 'Research Utilized', 'Co-Lead Researcher', 'Basic Research ', 'Self Funded', '5456.00', 'Funders', '2021-12-31', '2021-03-15', '2022-02-14', 'Agency', 'Utilized', 'Local-PUP', 'progress.docx', '6757-progress.docx', 0),
(2, 14, 'Study', 'Research', 'Poverty Reduction', 'Another Utilized', 'Independent Researcher', 'Basic Research ', 'Self Funded', '213.00', 'fsdf', '2021-01-14', '2021-11-13', '2021-12-15', 'Org', 'Brief', 'Regional', 'Atanque, Juhn Emmanuel F. BSIT 3-4 Activity 1.pdf', '5198-Atanque, Juhn Emmanuel F. BSIT 3-4 Activity 1.pdf', 0),
(3, 14, 'Study', 'Book Chapter', 'Poverty Reduction', 'Cool Research Title', 'Lead Researcher', 'Creative Work ', 'Self Funded', 's', '2', '2015-11-12', '2015-11-15', '2021-03-12', 'sdf', '2qw', 'National', 'Atanque, Juhn Emmanuel F. BSIT 3-4 Activity 1.docx', '2360-Atanque, Juhn Emmanuel F. BSIT 3-4 Activity 1.docx', 1),
(4, 14, 'Program', 'Research', 'Poverty Reduction', 'another research title', 'Independent Researcher', 'Applied Research ', 'Externally Funded', '40500', 'Card Bank Inc.', '2021-01-11', '2021-12-12', '2023-12-13', 'Agency utilizers', 'Brief but concise', 'National', 'Atanque, Juhn Emmanuel F. BSIT 3-4 Activity 3.docx', '5704-Atanque, Juhn Emmanuel F. BSIT 3-4 Activity 3.docx', 0),
(5, 38, 'Study', 'Research', 'Accelerating Infrastructure Development through Science and Technology', 'Empirical Analysis of Value Investing Strategy in Times of Subprime Mortgage Crisis', 'Co-Lead Researcher', 'Basic Research ', 'University Funded', '5,000', 'PUP', '2017-09-13', '2020-12-12', '2020-01-11', 'Crisis Prevention Group', 'Utilized', 'National', 'Atanque, Juhn Emmanuel F.  OCA.docx', '6579-Atanque, Juhn Emmanuel F.  OCA.docx', 0),
(6, 42, 'Project', 'Research', 'Peace and Security', 'Exploring the Experiences of People Living with HIV in the Philippines: Modelling Muscle Ache/Pain a', 'Independent Researcher', 'Basic Research (GAD Related)', 'Externally Funded', '9,000', 'BPI', '2018-02-02', '2018-03-31', '2018-03-02', 'Org', 'Study aims to breakdown HIV', 'Provincial/City/Municipal', 'Atanque Juhn Emmanuel F BSIT 4-4 Gawain 2 October 31,2021.docx', '2253-Atanque Juhn Emmanuel F BSIT 4-4 Gawain 2 October 31,2021.docx', 0),
(7, 48, 'Program', 'Book Chapter', 'Poverty Reduction', 'Investing in Microfinance: A Portfolio Optimization Approach', 'Lead Researcher', 'Applied Research ', 'Externally Funded', '13,000', 'BPI', '2019-07-24', '2019-09-14', '2019-08-02', 'Org', 'Aims for the improvement of lending', 'Provincial/City/Municipal', 'tables involved.docx', '2662-tables involved.docx', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ro_keywords`
--

CREATE TABLE `ro_keywords` (
  `Ro_keywordsId` bigint(20) NOT NULL,
  `RoId` bigint(20) NOT NULL,
  `RoKeyword` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ro_keywords`
--

INSERT INTO `ro_keywords` (`Ro_keywordsId`, `RoId`, `RoKeyword`) VALUES
(1, 1, 'cool'),
(2, 1, 'great'),
(3, 1, 'wow'),
(4, 1, 'amazing'),
(6, 3, 'word'),
(7, 3, 'worder'),
(8, 3, 'wordest'),
(9, 3, 'more wordest'),
(24, 2, 'cooler'),
(25, 2, 'cold'),
(65, 4, 'Tex'),
(66, 4, 'texter'),
(67, 4, 'textest'),
(68, 4, 'texdsf'),
(69, 4, 'tetttttt'),
(81, 6, 'dame '),
(82, 6, 'nanuyo'),
(83, 6, 'suki'),
(84, 6, 'baka '),
(85, 6, 'mitai'),
(91, 7, 'sdfr'),
(92, 7, 'sdf'),
(93, 7, 'eee'),
(94, 7, 'wwww'),
(95, 7, 'qqqq'),
(131, 8, 'fff'),
(132, 8, 'oooooo'),
(133, 8, 'ddd'),
(134, 8, 'gggg'),
(135, 8, 'wwww'),
(141, 5, 'Kore'),
(142, 5, 'wa'),
(143, 5, 'requiem'),
(144, 5, 'wo'),
(145, 5, 'da'),
(146, 9, 'dolphin'),
(147, 9, 'stand'),
(148, 9, 'za warudo'),
(149, 9, 'star platinum'),
(150, 9, 'yare yare'),
(151, 10, 'reduction'),
(152, 10, 'risk'),
(153, 10, 'management'),
(154, 10, 'prevention'),
(155, 10, 'solution'),
(171, 1, 'tex'),
(173, 2, 'g'),
(174, 2, 'f'),
(175, 2, 'sdafdsdf'),
(176, 3, 'sdfsdweee'),
(178, 12, 'this'),
(179, 12, 'word'),
(180, 12, 'is '),
(181, 12, 'here'),
(182, 12, 'yeah'),
(183, 0, 'ddd'),
(184, 0, 'ww'),
(185, 0, 'qq'),
(186, 0, 'ee'),
(187, 0, 'qq'),
(188, 13, 'dq'),
(189, 13, 'dw'),
(190, 13, 'ds'),
(191, 13, 'aw'),
(192, 13, 's'),
(193, 14, 'one'),
(194, 14, 'two'),
(195, 14, 'three'),
(196, 14, 'four'),
(197, 14, 'five'),
(198, 15, 'Consumer'),
(199, 15, 'Modelling'),
(200, 15, 'Teaching'),
(201, 15, 'conversion'),
(202, 15, 'CFPB'),
(203, 16, 'Risk'),
(204, 16, 'Equity'),
(205, 16, 'Liquidity'),
(206, 16, 'Premiums'),
(207, 16, 'Impact'),
(208, 17, 'Education'),
(209, 17, 'Recession'),
(210, 17, 'Labor'),
(211, 17, 'Market'),
(212, 17, 'Overeducation'),
(213, 18, 'Nature'),
(214, 18, 'Disaster'),
(215, 18, 'Measurement'),
(216, 18, 'Dimesnions'),
(217, 18, 'Impact'),
(223, 19, 'Account'),
(224, 19, 'Corporate'),
(225, 19, 'Communication'),
(226, 19, 'Business'),
(227, 19, 'Worth'),
(228, 20, 'Obesity'),
(229, 20, 'Health'),
(230, 20, 'Education'),
(231, 20, 'Impact'),
(232, 20, 'Community'),
(233, 11, 'LLP'),
(234, 11, 'Research'),
(235, 11, 'Development'),
(236, 11, 'Science '),
(237, 11, 'Tech');

-- --------------------------------------------------------

--
-- Table structure for table `ro_name`
--

CREATE TABLE `ro_name` (
  `Ro_nameId` bigint(20) NOT NULL,
  `RoId` bigint(20) NOT NULL,
  `RoName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ro_name`
--

INSERT INTO `ro_name` (`Ro_nameId`, `RoId`, `RoName`) VALUES
(1, 1, 'John Johner'),
(2, 1, 'Mark Marker'),
(3, 1, 'James Jameson'),
(4, 1, 'Christian Christianer'),
(5, 3, 'oswald oswald'),
(6, 3, 'Melon Musk'),
(7, 3, 'Steve Jabs'),
(8, 3, 'Cringe Jokes'),
(26, 2, 'Mike Miker'),
(27, 2, 'Dan Daniels'),
(58, 4, 'James Bond'),
(59, 4, 'Emanuel Emans'),
(60, 4, 'Steve Stevenson'),
(61, 4, 'Giorno Giovani'),
(64, 6, 'Dame Dame'),
(65, 6, 'Dame Yo'),
(73, 7, 'Stephen Stephenson'),
(74, 7, 'Person personer'),
(75, 7, 'Another Guy'),
(76, 7, 'One more guy'),
(77, 7, 'last guy'),
(78, 7, 'one more'),
(93, 8, 'dfs'),
(94, 8, 'dfsfff'),
(95, 8, 'another name'),
(98, 5, 'Jotaro Kujo'),
(99, 5, 'Josuke Joestar'),
(100, 9, 'Jotaro Kujo'),
(101, 9, 'Jolyne Kujo'),
(102, 10, 'George Georgy'),
(110, 12, 'Giorno Giovani'),
(111, 12, 'dan dan'),
(112, 12, 'yes yes'),
(113, 0, 'Giorno Giovani'),
(114, 0, 'David Davidson'),
(115, 13, 'Sam Samuel'),
(116, 13, 'Giorno Giovani'),
(117, 14, 'Karen stephan'),
(118, 14, 'Giorno Giovani'),
(119, 15, 'Giorno Giovani'),
(120, 15, 'David Davidson'),
(121, 16, 'David Davidson'),
(122, 17, 'Karen stephan'),
(123, 18, 'James Jameson'),
(125, 19, 'James Jameson'),
(126, 20, 'James Jameson'),
(127, 11, 'Sagum Ria A.'),
(128, 11, 'Atanque Juhn'),
(129, 11, 'Karen stephan');

-- --------------------------------------------------------

--
-- Table structure for table `rpres_keywords`
--

CREATE TABLE `rpres_keywords` (
  `RpresKeywordId` bigint(20) NOT NULL,
  `RpresId` bigint(20) NOT NULL,
  `RpresKeyword` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rpres_keywords`
--

INSERT INTO `rpres_keywords` (`RpresKeywordId`, `RpresId`, `RpresKeyword`) VALUES
(1, 1, 'Hamon'),
(2, 1, 'Drive'),
(3, 1, 'Sunlight'),
(4, 1, 'Over'),
(5, 1, 'Beat'),
(11, 3, 'a'),
(12, 3, 'b'),
(13, 3, 'c'),
(14, 3, 'd'),
(15, 3, 'e'),
(81, 2, 'yes'),
(82, 2, 'yess'),
(83, 2, 'yesss'),
(84, 2, 'yessss'),
(85, 2, 'yessssss'),
(86, 5, 'HDI'),
(87, 5, 'Application'),
(88, 5, 'Development'),
(89, 5, 'Adjustment'),
(90, 5, 'Sustainability'),
(91, 6, 'Spatial'),
(92, 6, 'COVID'),
(93, 6, 'Dining'),
(94, 6, 'School'),
(95, 6, 'PUP'),
(96, 7, 'Dissolution'),
(97, 7, 'Offline'),
(98, 7, 'Online'),
(99, 7, 'Couples'),
(100, 7, 'Versus'),
(101, 8, 'CFPB'),
(102, 8, 'Consumer'),
(103, 8, 'Complaint'),
(104, 8, 'Learning'),
(105, 8, 'Consumer'),
(106, 9, 'Root'),
(107, 9, 'Stock'),
(108, 9, 'Philippines'),
(109, 9, 'Index'),
(110, 9, 'Reversion'),
(111, 4, 'Relevant'),
(112, 4, 'Pioneer'),
(113, 4, 'Funded'),
(114, 4, 'Innovative'),
(115, 4, 'Important');

-- --------------------------------------------------------

--
-- Table structure for table `rpres_name`
--

CREATE TABLE `rpres_name` (
  `RpresNameId` bigint(20) NOT NULL,
  `RpresId` bigint(20) NOT NULL,
  `RpresName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rpres_name`
--

INSERT INTO `rpres_name` (`RpresNameId`, `RpresId`, `RpresName`) VALUES
(1, 1, 'Jonathan Joestar'),
(2, 1, 'Erina Joestar'),
(9, 3, 'Charlie Kaufman'),
(10, 3, 'M night'),
(61, 2, 'Jack Atlas'),
(62, 2, 'Yusei Fudo'),
(63, 2, 'David Davidson'),
(64, 5, 'David Davidson'),
(65, 5, 'Carl Carlson'),
(66, 6, 'Giorno Giovani'),
(67, 6, 'James Jameson'),
(68, 7, 'David Davidson'),
(69, 7, 'Karen stephan'),
(70, 7, 'Gab Gabe'),
(71, 8, 'David Davidson'),
(72, 9, 'Karen stephan'),
(73, 9, 'James Jameson'),
(74, 4, 'ho lee fuk'),
(75, 4, 'Dam son'),
(76, 4, 'Karen stephan');

-- --------------------------------------------------------

--
-- Table structure for table `rp_keywords`
--

CREATE TABLE `rp_keywords` (
  `Rp_keywordsId` bigint(20) NOT NULL,
  `RpId` bigint(20) NOT NULL,
  `RpKeyword` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rp_keywords`
--

INSERT INTO `rp_keywords` (`Rp_keywordsId`, `RpId`, `RpKeyword`) VALUES
(32, 1, 'cool'),
(33, 1, 'great'),
(34, 1, 'wow'),
(35, 1, 'amazing'),
(36, 1, 'yeah'),
(57, 3, 'q'),
(58, 3, 'w'),
(59, 3, 'e'),
(60, 3, 'r'),
(61, 3, 't'),
(67, 2, 'wo'),
(68, 2, 'wor'),
(69, 2, 'word'),
(70, 2, 'words'),
(71, 2, 'words?'),
(102, 5, 'd3wer'),
(103, 5, 'fdsfd'),
(104, 5, 'ewewe'),
(105, 5, 'ssdf'),
(106, 5, 'dfs'),
(107, 6, 'e'),
(108, 6, 'q'),
(109, 6, 'w'),
(110, 6, 'w'),
(111, 6, 'r'),
(117, 7, 'e'),
(118, 7, 'fe'),
(119, 7, 'd'),
(120, 7, 'd'),
(121, 7, 'd'),
(122, 8, 'Social'),
(123, 8, 'Funds'),
(124, 8, 'PPP'),
(125, 8, 'Online '),
(126, 8, 'Lenders'),
(127, 9, 'Politics'),
(128, 9, 'Coalition'),
(129, 9, 'Effects'),
(130, 9, 'Philippines'),
(131, 9, 'factors'),
(132, 10, 'Dropout'),
(133, 10, 'College'),
(134, 10, 'Programs'),
(135, 10, 'Future'),
(136, 10, 'Access'),
(137, 4, 'Pioneer'),
(138, 4, 'Revolutionary'),
(139, 4, 'Ground-breaking'),
(140, 4, 'extravagant'),
(141, 4, 'expensive');

-- --------------------------------------------------------

--
-- Table structure for table `rp_name`
--

CREATE TABLE `rp_name` (
  `Rp_nameId` bigint(20) NOT NULL,
  `RpId` bigint(20) NOT NULL,
  `RpName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rp_name`
--

INSERT INTO `rp_name` (`Rp_nameId`, `RpId`, `RpName`) VALUES
(16, 3, 'Karen stephan'),
(17, 3, 'Nene Nene'),
(18, 1, 'James Jameson'),
(19, 1, 'Cooler James'),
(22, 2, 'Neil Breen'),
(23, 2, 'Charlie Kaufman'),
(35, 5, 'Giorno Giovani'),
(36, 6, 'wer'),
(40, 7, 'Karen stephan'),
(41, 7, 'ho lee fuk'),
(42, 8, 'David Davidson'),
(43, 8, 'Charlie Kaufman'),
(44, 9, 'Giorno Giovani'),
(45, 10, 'James Jameson'),
(46, 4, 'yes'),
(47, 4, 'Carl Carlson');

-- --------------------------------------------------------

--
-- Table structure for table `ru_keywords`
--

CREATE TABLE `ru_keywords` (
  `RuKeywordsId` bigint(20) NOT NULL,
  `UtiId` bigint(20) NOT NULL,
  `RuKeyword` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ru_keywords`
--

INSERT INTO `ru_keywords` (`RuKeywordsId`, `UtiId`, `RuKeyword`) VALUES
(76, 1, 'one'),
(77, 1, 'two'),
(78, 1, 'three'),
(79, 1, 'four'),
(80, 1, 'end'),
(81, 2, 'poverty'),
(82, 2, 'sustenance'),
(83, 2, 'Idea'),
(84, 2, 'help'),
(85, 2, 'adress'),
(86, 3, 'e'),
(87, 3, 's'),
(88, 3, 'd'),
(89, 3, 'w'),
(90, 3, 's'),
(101, 5, 'Analysis'),
(102, 5, 'Investment'),
(103, 5, 'Mortgage'),
(104, 5, 'Crisis'),
(105, 5, 'Empirical'),
(106, 6, 'HIV'),
(107, 6, 'Muscle'),
(108, 6, 'Pain'),
(109, 6, 'Illness'),
(110, 6, 'Health'),
(111, 7, 'Microfinance'),
(112, 7, 'Investing'),
(113, 7, 'Approach'),
(114, 7, 'Optimization'),
(115, 7, 'Portfolio'),
(121, 4, 'Relevant'),
(122, 4, 'Accesible'),
(123, 4, 'Reusable'),
(124, 4, 'Available'),
(125, 4, 'Research');

-- --------------------------------------------------------

--
-- Table structure for table `ru_name`
--

CREATE TABLE `ru_name` (
  `RuNameId` bigint(20) NOT NULL,
  `UtiId` bigint(20) NOT NULL,
  `RuName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ru_name`
--

INSERT INTO `ru_name` (`RuNameId`, `UtiId`, `RuName`) VALUES
(26, 1, 'Karen stephan'),
(27, 1, 'Dan Daniels'),
(29, 2, 'James Jameson'),
(30, 3, 'Carl Marks'),
(32, 5, 'Carl Carlson'),
(33, 5, 'Charlie Kaufman'),
(34, 6, 'Karen stephan'),
(35, 7, 'David Davidson'),
(37, 4, 'Karen stephan');

-- --------------------------------------------------------

--
-- Table structure for table `schoolyear`
--

CREATE TABLE `schoolyear` (
  `YearId` bigint(20) NOT NULL,
  `SchoolYear` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schoolyear`
--

INSERT INTO `schoolyear` (`YearId`, `SchoolYear`) VALUES
(1, '2020'),
(2, '2021'),
(3, '2019'),
(4, '2018'),
(5, '2022');

-- --------------------------------------------------------

--
-- Table structure for table `specialtasks`
--

CREATE TABLE `specialtasks` (
  `StId` bigint(20) NOT NULL,
  `SubmissionId` bigint(20) NOT NULL,
  `StDesc` varchar(50) NOT NULL,
  `StOutput` varchar(50) NOT NULL,
  `StOutcome` varchar(50) NOT NULL,
  `StParticipation` varchar(50) NOT NULL,
  `StSpecial` varchar(50) NOT NULL,
  `StLevel` varchar(50) NOT NULL,
  `StDateFrom` date NOT NULL,
  `StDateTo` date NOT NULL,
  `StNature` varchar(100) NOT NULL,
  `StFilename` varchar(100) NOT NULL,
  `StTempName` varchar(100) NOT NULL,
  `RevStat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `specialtasks`
--

INSERT INTO `specialtasks` (`StId`, `SubmissionId`, `StDesc`, `StOutput`, `StOutcome`, `StParticipation`, `StSpecial`, `StLevel`, `StDateFrom`, `StDateTo`, `StNature`, `StFilename`, `StTempName`, `RevStat`) VALUES
(1, 14, 'special', 'this', 'that', 'yes', 'them', 'Local-PUP', '2021-12-30', '2024-02-14', 'Yes', 'from dictionary to requirements.pptx', '5541-from dictionary to requirements.pptx', 1),
(2, 14, 'Accomplished oversees', 'Journal ', 'Conference ', 'Writer', 'None at the moment', 'National', '2021-02-12', '2023-12-12', '', 'tables involved.docx', '2015-tables involved.docx', 0);

-- --------------------------------------------------------

--
-- Table structure for table `submission`
--

CREATE TABLE `submission` (
  `SubmissionId` bigint(11) NOT NULL,
  `QuarterId` bigint(11) NOT NULL,
  `UserId` bigint(11) NOT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `SubmissionStatus` varchar(50) NOT NULL,
  `DateSubmitted` date DEFAULT NULL,
  `ValidationStatus` varchar(100) NOT NULL,
  `RevStat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `submission`
--

INSERT INTO `submission` (`SubmissionId`, `QuarterId`, `UserId`, `DateCreated`, `SubmissionStatus`, `DateSubmitted`, `ValidationStatus`, `RevStat`) VALUES
(14, 16, 3, '2021-12-11 00:38:21', 'Submitted', '2021-12-11', '', 1),
(30, 16, 1, '2021-11-21 07:22:46', 'Submitted', '2021-10-30', 'Accepted', 0),
(33, 16, 10, '2021-11-21 07:22:49', 'Submitted', '2021-11-04', 'Accepted', 0),
(34, 16, 12, '2021-11-24 06:37:38', 'Submitted', '2021-11-05', 'Accepted', 0),
(35, 16, 9, '2021-11-21 07:22:55', 'Submitted', '2021-11-06', 'Accepted', 0),
(36, 16, 11, '2022-01-03 09:32:33', 'Submitted', '2021-11-21', 'Accepted', 0),
(37, 16, 14, '2021-11-21 07:23:08', 'Submitted', '2021-11-06', 'Accepted', 0),
(38, 12, 3, '2021-12-09 02:19:44', 'Submitted', '2020-12-12', 'Accepted', 1),
(39, 12, 11, '2021-11-21 08:30:25', 'Submitted', '2020-11-02', 'Accepted', 0),
(40, 1, 1, '2021-11-21 08:30:30', 'Submitted', '2018-02-21', 'Accepted', 0),
(41, 1, 10, '2021-11-21 08:31:06', 'Submitted', '2018-01-29', 'Accepted', 0),
(42, 1, 9, '2021-11-21 08:37:31', 'Submitted', '2018-01-15', 'Accepted', 0),
(43, 2, 3, '2021-11-21 09:55:02', 'Submitted', '2018-04-04', 'Accepted', 0),
(44, 3, 12, '2021-11-21 09:55:08', 'Submitted', '2018-06-30', 'Accepted', 0),
(45, 4, 11, '2021-11-21 09:55:14', 'Submitted', '2018-12-12', 'Accepted', 0),
(46, 5, 1, '2021-11-22 02:21:02', 'Submitted', '2019-03-03', 'Accepted', 0),
(47, 6, 10, '2021-11-22 02:21:17', 'Submitted', '2019-05-05', 'Accepted', 0),
(48, 7, 10, '2021-11-22 02:21:32', 'Submitted', '2019-07-07', 'Accepted', 0),
(49, 7, 11, '2021-11-22 02:21:51', 'Submitted', '2019-09-09', 'Accepted', 0),
(50, 8, 1, '2021-11-22 02:22:03', 'Submitted', '2019-11-12', 'Accepted', 0),
(51, 9, 3, '2021-11-22 02:22:27', 'Submitted', '2020-01-11', 'Accepted', 0),
(52, 10, 1, '2021-11-22 02:22:52', 'Submitted', '2020-05-21', 'Accepted', 0),
(53, 11, 9, '2021-11-22 02:23:15', 'Submitted', '2020-07-21', 'Accepted', 0),
(54, 11, 10, '2021-11-22 02:23:25', 'Submitted', '2020-07-14', 'Accepted', 0),
(55, 13, 3, '2021-11-22 02:23:47', 'Submitted', '2021-02-04', 'Accepted', 0),
(56, 13, 1, '2022-01-03 09:32:33', 'Submitted', NULL, '', 0),
(57, 14, 10, '2022-01-03 09:32:33', 'Submitted', NULL, '', 0),
(58, 16, 16, '2021-12-09 04:08:38', 'Submitted', '2021-12-04', 'Accepted', 0),
(59, 16, 8, '2021-12-06 00:39:42', 'Submitted', '2021-12-06', '', 0),
(61, 16, 19, '2021-12-16 02:57:36', 'Submitted', '2021-12-16', 'Accepted', 0),
(62, 2124, 3, '2022-01-26 07:24:42', 'Submitted', '2022-01-26', '', 0),
(63, 2124, 1, '2022-03-29 02:03:48', 'Ongoing', NULL, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `timeliness_rate`
--

CREATE TABLE `timeliness_rate` (
  `TRId` bigint(20) NOT NULL,
  `EpId` bigint(20) NOT NULL,
  `TRPoor` varchar(50) NOT NULL,
  `TRFair` varchar(50) NOT NULL,
  `TRSatisfactory` varchar(50) NOT NULL,
  `TRVery` varchar(50) NOT NULL,
  `TROutstanding` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `timeliness_rate`
--

INSERT INTO `timeliness_rate` (`TRId`, `EpId`, `TRPoor`, `TRFair`, `TRSatisfactory`, `TRVery`, `TROutstanding`) VALUES
(1, 1, '6', '7', '8', '9', '10'),
(2, 2, '2', '8', '5', '10', '25');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserId` bigint(20) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `UserPassword` varchar(20) NOT NULL,
  `UserLevel` varchar(20) NOT NULL,
  `RealName` varchar(50) NOT NULL,
  `College` varchar(50) NOT NULL,
  `Faculty_id` bigint(20) NOT NULL,
  `UserEmail` varchar(100) NOT NULL,
  `code` int(11) NOT NULL,
  `UserPhoto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserId`, `UserName`, `UserPassword`, `UserLevel`, `RealName`, `College`, `Faculty_id`, `UserEmail`, `code`, `UserPhoto`) VALUES
(1, 'John ', '12345', 'Faculty Member', 'John Johner', 'CCIS', 1, 'a@gmail.com', 0, ''),
(3, 'Mark', '12345', 'Faculty Member', 'Mark Marker', 'CCIS', 2, 'b@gmail.com', 0, '4230-artworks-000420504324-qbn3os-t500x500.jpg'),
(4, 'Daniel', '12345', 'Dean', 'Daniel Daniels', 'CCIS', 3, 'c@gmail.com', 0, ''),
(5, 'Danieler', '12345', 'Dean', 'Danieler Daniels', 'CHK', 4, 'd@gmail.com', 0, ''),
(6, 'Danielererst', '12345', 'Dean', 'Danielerert Daniels', 'COED', 5, 'e@gmail.com', 0, ''),
(7, 'can', '12345', 'Dean', 'Can Canner', 'CL', 6, 'f@gmail.com', 0, ''),
(8, 'Charlie', '12345', 'Researcher', 'Charlie Kaufman', 'COED', 7, 'g@gmail.com', 0, ''),
(9, 'Karen ', '12345', 'Faculty Member', 'Karen Stephan', 'CCIS', 8, 'ah@gmail.com', 0, ''),
(10, 'Guy', '12345', 'Faculty Member', 'George Georger', 'CL', 9, 'i@gmail.com', 0, ''),
(11, 'Kevin', '12345', 'Faculty Member', 'Kevin Keviner', 'CL', 10, 'j@gmail.com', 0, ''),
(12, 'James', '12345', 'Faculty Member', 'James Jameson', 'CHK', 11, 'k@gmail.com', 0, ''),
(13, 'don', '12345', 'Faculty Member', 'don don', 'CCIS', 12, 'la@gmail.com', 0, ''),
(14, 'Lorenz', '12345', 'Faculty Member', 'Laurence Lopez', 'CCIS', 13, 'ma@gmail.com', 0, ''),
(15, 'person', '12345', 'Faculty Member', 'john pirce', 'CCIS', 14, 'na@gmail.com', 0, ''),
(16, 'Ronaldo', 'insertedtext', 'Researcher', 'Ronaldo Carpio', 'CCIS', 16, 'jeanedarcalter@gmail.com', 0, ''),
(17, 'Christina', '12345', 'Faculty Member', 'Christina Bet', 'CL', 17, 'o@gmail.com', 0, ''),
(19, 'Gerald', 'kanekiken', 'Faculty Member', 'Gerald Rosas', 'CCIS', 20, 'juhnemmanuelatanque@gmail.com', 0, '6348-hide-the-pain-harold.jpg'),
(20, 'cruz', '827ccb0eea8a706c4c34', 'Faculty Member', 'Justin Cruz', 'CCIS', 21, 'myemail@gmail.com', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `viabledemo`
--

CREATE TABLE `viabledemo` (
  `VdId` bigint(20) NOT NULL,
  `SubmissionId` bigint(20) NOT NULL,
  `VdName` varchar(100) NOT NULL,
  `VdRevenue` varchar(100) NOT NULL,
  `VdCost` varchar(100) NOT NULL,
  `VdDateStart` date NOT NULL,
  `VdRate` varchar(100) NOT NULL,
  `VdFilename` varchar(100) NOT NULL,
  `VdTempName` varchar(100) NOT NULL,
  `RevStat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `viabledemo`
--

INSERT INTO `viabledemo` (`VdId`, `SubmissionId`, `VdName`, `VdRevenue`, `VdCost`, `VdDateStart`, `VdRate`, `VdFilename`, `VdTempName`, `RevStat`) VALUES
(1, 14, '1st', '4,000', '1,000', '2022-01-13', '20', 'Atanque, Juhn Emmanuel F. BSIT 3-4.pdf', '9104-Atanque, Juhn Emmanuel F. BSIT 3-4.pdf', 1),
(2, 14, '2nd', '12000', '5000', '2021-01-09', '', 'Group 9 week 4 Prototype Progress.docx', '7243-Group 9 week 4 Prototype Progress.docx', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addstat`
--
ALTER TABLE `addstat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `attendancedp`
--
ALTER TABLE `attendancedp`
  ADD PRIMARY KEY (`AdId`);

--
-- Indexes for table `attendancet`
--
ALTER TABLE `attendancet`
  ADD PRIMARY KEY (`AtId`);

--
-- Indexes for table `attendanceu`
--
ALTER TABLE `attendanceu`
  ADD PRIMARY KEY (`AuId`);

--
-- Indexes for table `awardorg`
--
ALTER TABLE `awardorg`
  ADD PRIMARY KEY (`AoId`);

--
-- Indexes for table `awards`
--
ALTER TABLE `awards`
  ADD PRIMARY KEY (`AwardsId`);

--
-- Indexes for table `collaborators`
--
ALTER TABLE `collaborators`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `college`
--
ALTER TABLE `college`
  ADD PRIMARY KEY (`CollegeId`);

--
-- Indexes for table `copyrightedoutput`
--
ALTER TABLE `copyrightedoutput`
  ADD PRIMARY KEY (`CoId`);

--
-- Indexes for table `co_keywords`
--
ALTER TABLE `co_keywords`
  ADD PRIMARY KEY (`CoKeywordsId`);

--
-- Indexes for table `co_name`
--
ALTER TABLE `co_name`
  ADD PRIMARY KEY (`CoNameId`);

--
-- Indexes for table `eservice_conference`
--
ALTER TABLE `eservice_conference`
  ADD PRIMARY KEY (`ConId`);

--
-- Indexes for table `eservice_consultant`
--
ALTER TABLE `eservice_consultant`
  ADD PRIMARY KEY (`EcId`);

--
-- Indexes for table `extensionprogram`
--
ALTER TABLE `extensionprogram`
  ADD PRIMARY KEY (`EpId`);

--
-- Indexes for table `extension_journals`
--
ALTER TABLE `extension_journals`
  ADD PRIMARY KEY (`EjId`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`Faculty_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`FeedbackId`);

--
-- Indexes for table `iicw`
--
ALTER TABLE `iicw`
  ADD PRIMARY KEY (`iicwId`);

--
-- Indexes for table `inolvementmobility`
--
ALTER TABLE `inolvementmobility`
  ADD PRIMARY KEY (`IMId`);

--
-- Indexes for table `membership`
--
ALTER TABLE `membership`
  ADD PRIMARY KEY (`MembershipId`);

--
-- Indexes for table `ongoingstudy`
--
ALTER TABLE `ongoingstudy`
  ADD PRIMARY KEY (`OngoingId`);

--
-- Indexes for table `opcr`
--
ALTER TABLE `opcr`
  ADD PRIMARY KEY (`OpId`);

--
-- Indexes for table `opcre`
--
ALTER TABLE `opcre`
  ADD PRIMARY KEY (`OeId`);

--
-- Indexes for table `opcrt`
--
ALTER TABLE `opcrt`
  ADD PRIMARY KEY (`OtId`);

--
-- Indexes for table `partnership`
--
ALTER TABLE `partnership`
  ADD PRIMARY KEY (`PartnershipId`);

--
-- Indexes for table `quality_rate`
--
ALTER TABLE `quality_rate`
  ADD PRIMARY KEY (`qId`);

--
-- Indexes for table `quarter`
--
ALTER TABLE `quarter`
  ADD PRIMARY KEY (`QuarterId`);

--
-- Indexes for table `rc_keywords`
--
ALTER TABLE `rc_keywords`
  ADD PRIMARY KEY (`RcKeywordId`);

--
-- Indexes for table `rc_name`
--
ALTER TABLE `rc_name`
  ADD PRIMARY KEY (`RcNameId`);

--
-- Indexes for table `relationprogram`
--
ALTER TABLE `relationprogram`
  ADD PRIMARY KEY (`RapId`);

--
-- Indexes for table `reqandque`
--
ALTER TABLE `reqandque`
  ADD PRIMARY KEY (`ReqId`);

--
-- Indexes for table `researchcitation`
--
ALTER TABLE `researchcitation`
  ADD PRIMARY KEY (`CitationId`);

--
-- Indexes for table `researchongoing`
--
ALTER TABLE `researchongoing`
  ADD PRIMARY KEY (`RoId`);

--
-- Indexes for table `researchpresentation`
--
ALTER TABLE `researchpresentation`
  ADD PRIMARY KEY (`RpresId`);

--
-- Indexes for table `researchpublication`
--
ALTER TABLE `researchpublication`
  ADD PRIMARY KEY (`RpId`);

--
-- Indexes for table `researchutilization`
--
ALTER TABLE `researchutilization`
  ADD PRIMARY KEY (`UtiId`);

--
-- Indexes for table `ro_keywords`
--
ALTER TABLE `ro_keywords`
  ADD PRIMARY KEY (`Ro_keywordsId`);

--
-- Indexes for table `ro_name`
--
ALTER TABLE `ro_name`
  ADD PRIMARY KEY (`Ro_nameId`);

--
-- Indexes for table `rpres_keywords`
--
ALTER TABLE `rpres_keywords`
  ADD PRIMARY KEY (`RpresKeywordId`);

--
-- Indexes for table `rpres_name`
--
ALTER TABLE `rpres_name`
  ADD PRIMARY KEY (`RpresNameId`);

--
-- Indexes for table `rp_keywords`
--
ALTER TABLE `rp_keywords`
  ADD PRIMARY KEY (`Rp_keywordsId`);

--
-- Indexes for table `rp_name`
--
ALTER TABLE `rp_name`
  ADD PRIMARY KEY (`Rp_nameId`);

--
-- Indexes for table `ru_keywords`
--
ALTER TABLE `ru_keywords`
  ADD PRIMARY KEY (`RuKeywordsId`);

--
-- Indexes for table `ru_name`
--
ALTER TABLE `ru_name`
  ADD PRIMARY KEY (`RuNameId`);

--
-- Indexes for table `schoolyear`
--
ALTER TABLE `schoolyear`
  ADD PRIMARY KEY (`YearId`);

--
-- Indexes for table `specialtasks`
--
ALTER TABLE `specialtasks`
  ADD PRIMARY KEY (`StId`);

--
-- Indexes for table `submission`
--
ALTER TABLE `submission`
  ADD PRIMARY KEY (`SubmissionId`);

--
-- Indexes for table `timeliness_rate`
--
ALTER TABLE `timeliness_rate`
  ADD PRIMARY KEY (`TRId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserId`);

--
-- Indexes for table `viabledemo`
--
ALTER TABLE `viabledemo`
  ADD PRIMARY KEY (`VdId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addstat`
--
ALTER TABLE `addstat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attendancedp`
--
ALTER TABLE `attendancedp`
  MODIFY `AdId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `attendancet`
--
ALTER TABLE `attendancet`
  MODIFY `AtId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `attendanceu`
--
ALTER TABLE `attendanceu`
  MODIFY `AuId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `awardorg`
--
ALTER TABLE `awardorg`
  MODIFY `AoId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `awards`
--
ALTER TABLE `awards`
  MODIFY `AwardsId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `collaborators`
--
ALTER TABLE `collaborators`
  MODIFY `Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `college`
--
ALTER TABLE `college`
  MODIFY `CollegeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `copyrightedoutput`
--
ALTER TABLE `copyrightedoutput`
  MODIFY `CoId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `co_keywords`
--
ALTER TABLE `co_keywords`
  MODIFY `CoKeywordsId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `co_name`
--
ALTER TABLE `co_name`
  MODIFY `CoNameId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `eservice_conference`
--
ALTER TABLE `eservice_conference`
  MODIFY `ConId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `eservice_consultant`
--
ALTER TABLE `eservice_consultant`
  MODIFY `EcId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `extensionprogram`
--
ALTER TABLE `extensionprogram`
  MODIFY `EpId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `extension_journals`
--
ALTER TABLE `extension_journals`
  MODIFY `EjId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `Faculty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `FeedbackId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `iicw`
--
ALTER TABLE `iicw`
  MODIFY `iicwId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `inolvementmobility`
--
ALTER TABLE `inolvementmobility`
  MODIFY `IMId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `membership`
--
ALTER TABLE `membership`
  MODIFY `MembershipId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ongoingstudy`
--
ALTER TABLE `ongoingstudy`
  MODIFY `OngoingId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `opcr`
--
ALTER TABLE `opcr`
  MODIFY `OpId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `opcre`
--
ALTER TABLE `opcre`
  MODIFY `OeId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `opcrt`
--
ALTER TABLE `opcrt`
  MODIFY `OtId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `partnership`
--
ALTER TABLE `partnership`
  MODIFY `PartnershipId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `quality_rate`
--
ALTER TABLE `quality_rate`
  MODIFY `qId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `quarter`
--
ALTER TABLE `quarter`
  MODIFY `QuarterId` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2125;

--
-- AUTO_INCREMENT for table `rc_keywords`
--
ALTER TABLE `rc_keywords`
  MODIFY `RcKeywordId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `rc_name`
--
ALTER TABLE `rc_name`
  MODIFY `RcNameId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `relationprogram`
--
ALTER TABLE `relationprogram`
  MODIFY `RapId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reqandque`
--
ALTER TABLE `reqandque`
  MODIFY `ReqId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `researchcitation`
--
ALTER TABLE `researchcitation`
  MODIFY `CitationId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `researchongoing`
--
ALTER TABLE `researchongoing`
  MODIFY `RoId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `researchpresentation`
--
ALTER TABLE `researchpresentation`
  MODIFY `RpresId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `researchpublication`
--
ALTER TABLE `researchpublication`
  MODIFY `RpId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `researchutilization`
--
ALTER TABLE `researchutilization`
  MODIFY `UtiId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ro_keywords`
--
ALTER TABLE `ro_keywords`
  MODIFY `Ro_keywordsId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=238;

--
-- AUTO_INCREMENT for table `ro_name`
--
ALTER TABLE `ro_name`
  MODIFY `Ro_nameId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `rpres_keywords`
--
ALTER TABLE `rpres_keywords`
  MODIFY `RpresKeywordId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `rpres_name`
--
ALTER TABLE `rpres_name`
  MODIFY `RpresNameId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `rp_keywords`
--
ALTER TABLE `rp_keywords`
  MODIFY `Rp_keywordsId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `rp_name`
--
ALTER TABLE `rp_name`
  MODIFY `Rp_nameId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `ru_keywords`
--
ALTER TABLE `ru_keywords`
  MODIFY `RuKeywordsId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `ru_name`
--
ALTER TABLE `ru_name`
  MODIFY `RuNameId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `schoolyear`
--
ALTER TABLE `schoolyear`
  MODIFY `YearId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `specialtasks`
--
ALTER TABLE `specialtasks`
  MODIFY `StId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `submission`
--
ALTER TABLE `submission`
  MODIFY `SubmissionId` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `timeliness_rate`
--
ALTER TABLE `timeliness_rate`
  MODIFY `TRId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `viabledemo`
--
ALTER TABLE `viabledemo`
  MODIFY `VdId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
