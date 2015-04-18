-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 17, 2015 at 11:22 PM
-- Server version: 5.5.42-cll
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `james_lolmobile`
--

-- --------------------------------------------------------

--
-- Table structure for table `challenge_bannedchampion`
--

CREATE TABLE `challenge_bannedchampion` (
  `championId` int(11) NOT NULL,
  `pickTurn` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matchId` bigint(20) NOT NULL,
  `teamId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `challenge_championinfo`
--

CREATE TABLE `challenge_championinfo` (
  `championId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `imageName` varchar(255) NOT NULL,
  UNIQUE KEY `championId` (`championId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `challenge_counts`
--

CREATE TABLE `challenge_counts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `championId` int(11) NOT NULL,
  `world` int(11) NOT NULL,
  `br` int(11) NOT NULL,
  `eune` int(11) NOT NULL,
  `euw` int(11) NOT NULL,
  `kr` int(11) NOT NULL,
  `lan` int(11) NOT NULL,
  `las` int(11) NOT NULL,
  `na` int(11) NOT NULL,
  `oce` int(11) NOT NULL,
  `ru` int(11) NOT NULL,
  `tr` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `championId` (`championId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `challenge_games`
--

CREATE TABLE `challenge_games` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matchId` bigint(20) NOT NULL,
  `region` varchar(255) NOT NULL DEFAULT 'global',
  PRIMARY KEY (`id`),
  KEY `matchId` (`matchId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `challenge_mastery`
--

CREATE TABLE `challenge_mastery` (
  `masteryId` bigint(20) NOT NULL,
  `rank` bigint(20) NOT NULL,
  `matchId` bigint(20) NOT NULL,
  `participantId` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `challenge_matchdetail`
--

CREATE TABLE `challenge_matchdetail` (
  `mapId` int(11) NOT NULL,
  `matchCreation` bigint(20) NOT NULL,
  `matchDuration` bigint(20) NOT NULL,
  `matchMode` varchar(255) NOT NULL,
  `matchType` varchar(255) NOT NULL,
  `matchVersion` varchar(255) NOT NULL,
  `platformId` varchar(255) NOT NULL,
  `queueType` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `season` varchar(255) NOT NULL,
  `matchId` bigint(20) NOT NULL,
  PRIMARY KEY (`matchId`),
  UNIQUE KEY `matchId` (`matchId`),
  KEY `matchId_2` (`matchId`),
  KEY `region` (`region`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `challenge_participant`
--

CREATE TABLE `challenge_participant` (
  `championId` int(11) NOT NULL,
  `highestAchievedSeasonTier` varchar(255) NOT NULL,
  `participantId` int(11) NOT NULL,
  `spell1Id` int(11) NOT NULL,
  `spell2Id` int(11) NOT NULL,
  `teamId` int(11) NOT NULL,
  `matchId` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `championId` (`championId`),
  KEY `participantId` (`participantId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `challenge_participantstats`
--

CREATE TABLE `challenge_participantstats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matchId` bigint(20) NOT NULL,
  `participantId` int(11) NOT NULL,
  `assists` bigint(20) NOT NULL,
  `champLevel` bigint(20) NOT NULL,
  `combatPlayerScore` bigint(20) NOT NULL,
  `deaths` bigint(20) NOT NULL,
  `doubleKills` bigint(20) NOT NULL,
  `firstBloodAssist` tinyint(1) NOT NULL,
  `firstBloodKill` tinyint(1) NOT NULL,
  `firstInhibitorAssist` tinyint(1) NOT NULL,
  `firstInhibitorKill` tinyint(1) NOT NULL,
  `firstTowerAssist` tinyint(1) NOT NULL,
  `firstTowerKill` tinyint(1) NOT NULL,
  `goldEarned` bigint(20) NOT NULL,
  `goldSpent` bigint(20) NOT NULL,
  `inhibitorKills` bigint(20) NOT NULL,
  `item0` bigint(20) NOT NULL,
  `item1` bigint(20) NOT NULL,
  `item2` bigint(20) NOT NULL,
  `item3` bigint(20) NOT NULL,
  `item4` bigint(20) NOT NULL,
  `item5` bigint(20) NOT NULL,
  `item6` bigint(20) NOT NULL,
  `killingSprees` bigint(20) NOT NULL,
  `kills` bigint(20) NOT NULL,
  `largestCriticalStrike` bigint(20) NOT NULL,
  `largestKillingSpree` bigint(20) NOT NULL,
  `largestMultiKill` bigint(20) NOT NULL,
  `magicDamageDealt` bigint(20) NOT NULL,
  `magicDamageDealtToChampions` bigint(20) NOT NULL,
  `magicDamageTaken` bigint(20) NOT NULL,
  `minionsKilled` bigint(20) NOT NULL,
  `neutralMinionsKilled` bigint(20) NOT NULL,
  `neutralMinionsKilledEnemyJungle` bigint(20) NOT NULL,
  `neutralMinionsKilledTeamJungle` bigint(20) NOT NULL,
  `pentaKills` bigint(20) NOT NULL,
  `physicalDamageDealt` bigint(20) NOT NULL,
  `physicalDamageDealtToChampions` bigint(20) NOT NULL,
  `physicalDamageTaken` bigint(20) NOT NULL,
  `quadraKills` bigint(20) NOT NULL,
  `sightWardsBoughtInGame` bigint(20) NOT NULL,
  `totalDamageDealt` bigint(20) NOT NULL,
  `totalDamageDealtToChampions` bigint(20) NOT NULL,
  `totalDamageTaken` bigint(20) NOT NULL,
  `totalHeal` bigint(20) NOT NULL,
  `totalTimeCrowdControlDealt` bigint(20) NOT NULL,
  `totalUnitsHealed` bigint(20) NOT NULL,
  `towerKills` bigint(20) NOT NULL,
  `tripleKills` bigint(20) NOT NULL,
  `trueDamageDealt` bigint(20) NOT NULL,
  `trueDamageDealtToChampions` bigint(20) NOT NULL,
  `trueDamageTaken` bigint(20) NOT NULL,
  `unrealKills` bigint(20) NOT NULL,
  `visionWardsBoughtInGame` bigint(20) NOT NULL,
  `wardsKilled` bigint(20) NOT NULL,
  `wardsPlaced` bigint(20) NOT NULL,
  `winner` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `matchId` (`matchId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `challenge_rune`
--

CREATE TABLE `challenge_rune` (
  `rank` bigint(20) NOT NULL,
  `runeId` bigint(20) NOT NULL,
  `matchId` bigint(20) NOT NULL,
  `participantId` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `challenge_team`
--

CREATE TABLE `challenge_team` (
  `baronKills` int(11) NOT NULL DEFAULT '0',
  `dragonKills` int(11) NOT NULL DEFAULT '0',
  `firstBaron` tinyint(1) NOT NULL DEFAULT '0',
  `firstBlood` tinyint(1) NOT NULL DEFAULT '0',
  `firstDragon` tinyint(1) NOT NULL DEFAULT '0',
  `firstInhibitor` tinyint(1) NOT NULL DEFAULT '0',
  `firstTower` tinyint(1) NOT NULL DEFAULT '0',
  `inhibitorKills` int(11) NOT NULL DEFAULT '0',
  `teamId` int(11) NOT NULL DEFAULT '0',
  `towerKills` int(11) NOT NULL DEFAULT '0',
  `winner` tinyint(1) NOT NULL DEFAULT '0',
  `matchId` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
