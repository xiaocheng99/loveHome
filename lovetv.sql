/*
SQLyog Ultimate v12.08 (64 bit)
MySQL - 5.5.28 : Database - lovetv
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`lovetv` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `lovetv`;

/*Table structure for table `comment` */

DROP TABLE IF EXISTS `comment`;

CREATE TABLE `comment` (
  `c_id` int(10) NOT NULL AUTO_INCREMENT,
  `c_ip` varchar(20) DEFAULT NULL,
  `c_city` varchar(20) DEFAULT NULL,
  `c_comment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB AUTO_INCREMENT=196 DEFAULT CHARSET=utf8;

/*Data for the table `comment` */

insert  into `comment`(`c_id`,`c_ip`,`c_city`,`c_comment`) values (1,NULL,NULL,'我想每天送你一束玫瑰，但我没有钱；'),(2,NULL,NULL,'我也想每天都送你巧克力，又怕你长多了肉来打我，'),(3,NULL,NULL,'所以我只能从今天开始每天都给你发短信来表达我对你的爱。'),(4,NULL,NULL,'.我愿全世界的女孩都变成你，那么想你就不用到处找你'),(5,NULL,NULL,'我又害怕全世界的女孩变成你，那么到哪我都放心不下你！'),(6,NULL,NULL,'.爱情是一个果酱罐，让我俩变成了小，快乐地尝着它的香甜，仿佛永远不知厌倦；'),(7,NULL,NULL,'爱情是一颗话梅果，让我俩变成了馋嘴的小熊，欲拒还迎那酸甜的滋味！'),(8,NULL,NULL,'.原本阴雨绵绵，忽然阳光初现；原本平静无波，忽然风急浪涌；原本生活苍白，忽然充满色彩'),(9,NULL,NULL,'一切，都是因为你的出现，让我的世界瞬间充满活力和精彩！'),(10,NULL,NULL,'想你了，让我们约会吧！'),(11,NULL,NULL,'想牵着你的手，漫步在晨曦黄昏，细听微风吟唱；'),(12,NULL,NULL,'想牵着你的手，斜看日升月落，让温情荡漾。别犹豫了，快点接受吧！'),(13,NULL,NULL,'我等着你呢，为你欠我的那个拥抱，我在学着尽力坚强；'),(14,NULL,NULL,'我等着你呢，为你说要牵我的手奔跑，我学会了爱惜我的手，只为让你一握的那刻温柔。'),(15,NULL,NULL,'7.爱情是一点巧遇；爱情是一点动心；'),(16,NULL,NULL,'爱情是一种默契；爱情是一种执著；'),(17,NULL,NULL,'爱情是一种忠诚；爱情是一种守望；爱情是一份信仰。而你就是我的爱情！'),(18,NULL,NULL,'爱情不是花荫下的甜言，不是桃花源中的蜜语，不是轻绵的眼泪，更不是死硬的强迫，'),(19,NULL,NULL,'初恋像柠檬，虽酸却耐人寻味'),(20,NULL,NULL,'热恋像火焰，虽热却不能自拔'),(21,NULL,NULL,'失恋像伤疤，虽痛却无法释怀'),(22,NULL,NULL,'所以我们要懂得呵护爱情！'),(23,NULL,NULL,'.爱你深深恋无穷，你的影子在心中'),(24,NULL,NULL,'今生今世恋不变，幸福相伴人相拥'),(25,NULL,NULL,'天长地久心连心，海枯石烂情永恒'),(26,NULL,NULL,'痴心常向你发送，牵手一生乐融融！'),(27,NULL,NULL,'路是一步一步走出来的。爱是一点一点换回来的'),(28,NULL,NULL,'人生也是这样一页一页真真实实活下去的'),(29,NULL,NULL,'我珍惜我的人生，更加珍惜你！'),(30,NULL,NULL,'.恨有多深，爱就有多深'),(31,NULL,NULL,'与其在爱与恨之间疲惫穿梭，不如挥慧剑斩情丝还自我一片海阔天空！'),(32,NULL,NULL,'有多少爱可以重来，有多少人愿意等待'),(33,NULL,NULL,'有多少短信可以重发，有多少词语是废话'),(34,NULL,NULL,'我无非是想告诉你，此生我已经把你认定，赶快举起手机投降吧！'),(35,NULL,NULL,'.在一齐一年在街上拉手那是恋情，在一齐五年还能拉手那是感情');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
