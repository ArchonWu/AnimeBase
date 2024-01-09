DROP TABLE Cast;
DROP TABLE Hires;
DROP TABLE SourceMaterialInfographics;
DROP TABLE SourceMaterialClassification;
DROP TABLE Category;
DROP TABLE Production;
DROP TABLE Artist;
DROP TABLE VoiceActor;
DROP TABLE Writer;
DROP TABLE SongType;
DROP TABLE SongRecord;
DROP TABLE Person;
DROP TABLE Characters;
DROP TABLE Anime;
DROP TABLE Studio;
DROP TABLE Genre;


CREATE TABLE Studio(
    name VARCHAR(20) NOT NULL,
    location VARCHAR(20),
    founding_year INT,
    PRIMARY KEY (name));
GRANT SELECT ON Studio TO PUBLIC;

CREATE TABLE Anime(
    title VARCHAR(40) NOT NULL,
    rating DECIMAL(2,1) NULL,
    demographic VARCHAR(20) NOT NULL,
    studio VARCHAR(20) NOT NULL,
    PRIMARY KEY (title),
    FOREIGN KEY (studio) REFERENCES Studio ON DELETE CASCADE);
GRANT SELECT ON Anime TO PUBLIC;

CREATE TABLE Genre(
    name VARCHAR(40) NOT NULL,
    PRIMARY KEY (name));
GRANT SELECT ON Genre TO PUBLIC;

CREATE TABLE Characters(
    name VARCHAR(20) NOT NULL,
    gender CHAR(1) NULL,
    role CHAR(20) NOT NULL,
    age INT NULL,
    world VARCHAR(40) NOT NULL,
    PRIMARY KEY (name),
    FOREIGN KEY(world) REFERENCES Anime ON DELETE CASCADE);
GRANT SELECT ON Characters TO PUBLIC;

CREATE TABLE Person(
    id INT NOT NULL,
    name VARCHAR(20) NOT NULL,
    role VARCHAR(20) NOT NULL,
    PRIMARY KEY (id));
GRANT SELECT ON Person TO PUBLIC;

CREATE TABLE Hires(
    studio_name VARCHAR(20) NOT NULL,
    person_id INT NOT NULL,
    PRIMARY KEY (studio_name, person_id),
    FOREIGN KEY (studio_name) REFERENCES Studio ON DELETE CASCADE,
    FOREIGN KEY (person_id) REFERENCES Person ON DELETE CASCADE);
GRANT SELECT ON Hires TO PUBLIC;

CREATE TABLE Writer(
    id INT NOT NULL,
    person_name VARCHAR(20) NOT NULL,
    person_role VARCHAR(20) NOT NULL,
    PRIMARY KEY (id));
GRANT SELECT ON Writer TO PUBLIC;

CREATE TABLE SourceMaterialClassification(
    genre VARCHAR(40) NOT NULL,
    target_audience VARCHAR(20) NOT NULL,
    PRIMARY KEY (genre));
GRANT SELECT ON SourceMaterialClassification TO PUBLIC;

CREATE TABLE SourceMaterialInfographics(
    title VARCHAR(40) NOT NULL,
    writer_id INT NOT NULL,
    type VARCHAR(20) NOT NULL,
    publisher VARCHAR(20) NOT NULL,
    num_volumes INT NOT NULL,
    release_date INT NOT NULL,
    anime_title VARCHAR(40) NULL,
    PRIMARY KEY (title),
    FOREIGN KEY (writer_id) REFERENCES Writer ON DELETE SET NULL,
    FOREIGN KEY (anime_title) REFERENCES Anime ON DELETE SET NULL);
GRANT SELECT ON SourceMaterialInfographics TO PUBLIC;

CREATE TABLE Artist(
    id INT NOT NULL,
    alias VARCHAR(20) NULL,
    person_name VARCHAR(20) NOT NULL,
    person_role VARCHAR(20) NOT NULL,
    PRIMARY KEY (id));
GRANT SELECT ON Artist TO PUBLIC;

CREATE TABLE SongRecord(
    title VARCHAR(40) NOT NULL,
    singer_name VARCHAR(20) NOT NULL,
    year_released INT NOT NULL,
    album VARCHAR(20) NOT NULL,
    PRIMARY KEY (title, year_released));
GRANT SELECT ON SongRecord TO PUBLIC;

CREATE TABLE SongType(
    id INT NOT NULL,
    title VARCHAR(40) NOT NULL,
    type VARCHAR(40) NOT NULL,
    PRIMARY KEY (id));
GRANT SELECT ON SongType TO PUBLIC;

CREATE TABLE VoiceActor(
    id INT NOT NULL,
    person_name VARCHAR(20) NOT NULL,
    person_role VARCHAR(20) NOT NULL,
    language VARCHAR(20) NOT NULL,
    PRIMARY KEY (id));
GRANT SELECT ON VoiceActor TO PUBLIC;

CREATE TABLE Category(
    anime_title VARCHAR(40) NOT NULL,
    genre_name VARCHAR(40) NOT NULL,
    PRIMARY KEY (anime_title, genre_name),
    FOREIGN KEY (anime_title) REFERENCES Anime ON DELETE CASCADE,
    FOREIGN KEY (genre_name) REFERENCES Genre ON DELETE CASCADE);
GRANT SELECT ON Category TO PUBLIC;

CREATE TABLE Production(
    anime_title VARCHAR(40) NOT NULL,
    studio_name VARCHAR(40) NOT NULL,
    release_date VARCHAR(40) NOT NULL,
    PRIMARY KEY (anime_title, studio_name),
    FOREIGN KEY (anime_title) REFERENCES Anime ON DELETE CASCADE,
    FOREIGN KEY (studio_name) REFERENCES Studio ON DELETE CASCADE);
GRANT SELECT ON Production TO PUBLIC;

CREATE TABLE Cast(
    anime_title VARCHAR(20) NOT NULL,
    character_name VARCHAR(20) NOT NULL,
    voice_actor_id INT NOT NULL,
    PRIMARY KEY (anime_title, character_name),
    FOREIGN KEY (anime_title) REFERENCES Anime ON DELETE CASCADE,
    FOREIGN KEY (character_name) REFERENCES Characters ON DELETE CASCADE,
    FOREIGN KEY (voice_actor_id) REFERENCES VoiceActor ON DELETE CASCADE);
GRANT SELECT ON Cast TO PUBLIC;

--Tuple 1: Full Metal Panic! (example of actual anime)
insert all
    into Genre values('Action')
    into Genre values('Comedy')
    into Genre values('Science Fiction')
    into Genre values('Humans')
    into Genre values('Animals')
    into Genre values('Aliens')
    into Genre values('Slice of Life')
    into Genre values('Robots')
    into Genre values('Technology')
    into Genre values('Cool')
    into Genre values('Cute')
    into Genre values('Firearms')
    into Genre values('Modern')
    into Genre values('Contemporary')
    into Genre values('School')
    into Genre values('Urban')
    into Genre values('Army')
    into Genre values('Swordplay')
    into Genre values('Magic')
    into Genre values('Music')
    into Genre values('Cars')
    into Genre values('Space')
    into Genre values('Gothic')
    into Genre values('Romance')
    into Genre values('Male Lead')
    into Genre values('Female Lead')
    into Genre values('Young Characters')
    into Genre values('Old Characters')
    into Genre values('Steampunk')
    into Genre values('Post-Apocalyptic')
    into Genre values('Drama')
    into Genre values('Fantasy')
    into Genre values('Horror')
    into Genre values('Mystic')
    into Genre values('Angels')
    into Genre values('Demons')
    into Studio values('Gonzo', 'TOKYO Naritahigashi', 2000)
    into Anime values('Full Metal Panic!', 7.6, 'Men', 'Gonzo')
    into Characters values('Sousuke Sagara',     'M', 'Main Character', 17, 'Full Metal Panic!')
    into Characters values('Kaname Chidori',     'F', 'Main Character', 16, 'Full Metal Panic!')
    into Characters values('Teletha Testarossa', 'F', 'Main Character', 16, 'Full Metal Panic!')
    into Characters values('Melissa Mao',        'F', 'Supporting Character', 25, 'Full Metal Panic!')
    into Characters values('Kurz Weber',         'M', 'Supporting Character', 19, 'Full Metal Panic!')
    into Characters values('Gauron',             'M', 'Supporting Character', 45, 'Full Metal Panic!')
    into Characters values('Andrey Kalinin',     'M', 'Supporting Character', NULL, 'Full Metal Panic!')
    into Characters values('Kyoko Tokiwa',       'F', 'Supporting Character', 16, 'Full Metal Panic!')
    into Characters values('Shinji Kazama',      'F', 'Supporting Character', 16, 'Full Metal Panic!')
    into Characters values('Richard Mardukas',   'M', 'Supporting Character', NULL, 'Full Metal Panic!')
    into Characters values('Grace Wiseman',      'F', 'Supporting Character', 20, 'Full Metal Panic!')
    into Person values(216, 'Shoji Gatoh',    'Writer')
    into Person values(217, 'Fumihiko Shimo', 'Writer')
    into Person values(218, 'Koichi Chigira',	'Writer')
    into Person values(219, 'Toshihiko Sahashi', 'Artist')
    into Person values(211, 'Kouichi Chigira',  'Director')
    into Person values(212, 'Shigeaki Tomioka', 'Producer')
    into Person values(213, 'Tsuneo Takechi',   'Producer')
    into Person values(214, 'Masafumi Fukui',   'Producer')
    into Person values(215, 'Toshihito Suzuki', 'Producer')
    into Person values(200, 'Sousuke Sagara',     'Voice Actor')
    into Person values(201, 'Kaname Chidori',     'Voice Actor')
    into Person values(202, 'Andrey Kalinin',     'Voice Actor')
    into Person values(203, 'Kyoko Tokiwa',       'Voice Actor')
    into Person values(204, 'Shinji Kazama',      'Voice Actor')
    into Person values(205, 'Gauron',             'Voice Actor')
    into Person values(206, 'Melissa Mao',        'Voice Actor')
    into Person values(207, 'Kurz Weber',         'Voice Actor')
    into Person values(208, 'Richard Mardukas',   'Voice Actor')
    into Person values(209, 'Teletha Testarossa', 'Voice Actor')
    into Person values(210, 'Grace Wiseman',      'Voice Actor')
    into Writer values(216, 'Shoji Gatoh',    'Writer')
    into Writer values(217, 'Fumihiko Shimo', 'Writer')
    into Writer values(218, 'Koichi Chigira',	'Writer')
    into Artist values(219, NULL, 'Toshihiko Sahashi', 'Artist')
    into Hires values('Gonzo', 200)
    into Hires values('Gonzo', 201)
    into Hires values('Gonzo', 202)
    into Hires values('Gonzo', 203)
    into Hires values('Gonzo', 204)
    into Hires values('Gonzo', 205)
    into Hires values('Gonzo', 206)
    into Hires values('Gonzo', 207)
    into Hires values('Gonzo', 208)
    into Hires values('Gonzo', 209)
    into Hires values('Gonzo', 210)
    into Hires values('Gonzo', 211)
    into Hires values('Gonzo', 212)
    into Hires values('Gonzo', 213)
    into Hires values('Gonzo', 214)
    into Hires values('Gonzo', 215)
    into Hires values('Gonzo', 216)
    into Hires values('Gonzo', 217)
    into Hires values('Gonzo', 218)
    into Hires values('Gonzo', 219)
    into SourceMaterialClassification values('Action', 'Males age 16-25')
    into SourceMaterialClassification values('Comedy', 'General')
    into SourceMaterialClassification values('Science Fiction', 'Males age 18-29')
    into SourceMaterialInfographics values('Full Metal Panic! Volume 1', 216, 'Light Novel', 'Fujimi Shobo', 23, 1998, 'Full Metal Panic!')
    into SourceMaterialInfographics values('Full Metal Panic! Volume 2', 216, 'Light Novel', 'Fujimi Shobo', 23, 1998, 'Full Metal Panic!')
    into SourceMaterialInfographics values('Full Metal Panic! Volume 3', 216, 'Light Novel', 'Fujimi Shobo', 23, 1998, 'Full Metal Panic!')
    into SongRecord values('Tomorrow', 'Mikuni Shimokawa', 2002,'392 BEST SELECTION')
    into SongRecord values('Karenai Hana', 'Mikuni Shimokawa', 2002,'392 BEST SELECTION')
    into SongType values(1, 'Tomorrow', 'Opening')
    into SongType values(2, 'Karenai Hana', 'Ending')
    into VoiceActor values(200, 'Sousuke Sagara',     'Voice Actor', 'Japanese')
    into VoiceActor values(201, 'Kaname Chidori',     'Voice Actor', 'Japanese')
    into VoiceActor values(202, 'Andrey Kalinin',     'Voice Actor', 'Japanese')
    into VoiceActor values(203, 'Kyoko Tokiwa',       'Voice Actor', 'Japanese')
    into VoiceActor values(204, 'Shinji Kazama',      'Voice Actor', 'Japanese')
    into VoiceActor values(205, 'Gauron',             'Voice Actor', 'Japanese')
    into VoiceActor values(206, 'Melissa Mao',        'Voice Actor', 'Japanese')
    into VoiceActor values(207, 'Kurz Weber',         'Voice Actor', 'Japanese')
    into VoiceActor values(208, 'Richard Mardukas',   'Voice Actor', 'Japanese')
    into VoiceActor values(209, 'Teletha Testarossa', 'Voice Actor', 'Japanese')
    into VoiceActor values(210, 'Grace Wiseman',      'Voice Actor', 'Japanese')
    into Category values('Full Metal Panic!','Action')
    into Category values('Full Metal Panic!','Comedy')
    into Category values('Full Metal Panic!','Animals')
    into Category values('Full Metal Panic!','Humans')
    into Category values('Full Metal Panic!','Science Fiction')
    into Category values('Full Metal Panic!','Cars')
    into Category values('Full Metal Panic!','Urban')
    into Category values('Full Metal Panic!','School')
    into Category values('Full Metal Panic!','Technology')
    into Category values('Full Metal Panic!','Music')
    into Category values('Full Metal Panic!','Gothic')
    into Category values('Full Metal Panic!','Swordplay')
    into Category values('Full Metal Panic!','Magic')
    into Category values('Full Metal Panic!','Male Lead')
    into Category values('Full Metal Panic!','Female Lead')
    into Category values('Full Metal Panic!','Young Characters')
    into Production values('Full Metal Panic!', 'Gonzo', '8 January 2002')
    into Cast values('Full Metal Panic!', 'Sousuke Sagara',     200)
    into Cast values('Full Metal Panic!', 'Kaname Chidori',     201)
    into Cast values('Full Metal Panic!', 'Andrey Kalinin',     202)
    into Cast values('Full Metal Panic!', 'Kyoko Tokiwa',       203)
    into Cast values('Full Metal Panic!', 'Shinji Kazama',      204)
    into Cast values('Full Metal Panic!', 'Gauron',             205)
    into Cast values('Full Metal Panic!', 'Melissa Mao',        206)
    into Cast values('Full Metal Panic!', 'Kurz Weber',         207)
    into Cast values('Full Metal Panic!', 'Richard Mardukas',   208)
    into Cast values('Full Metal Panic!', 'Teletha Testarossa', 209)
    into Cast values('Full Metal Panic!', 'Grace Wiseman',      210)
select * from dual;

--source: https://www.reddit.com/r/Animesuggest/comments/2omd13/anime_with_only_one_or_zero_characters/
--Tuple 2: short anime #1
insert all
    into Studio values('Studio Deen', 'TOKYO Musashino', 1975)
    into Anime values('Tenshi no Tamago', 7.7, 'Women', 'Studio Deen')
    into Characters values('Girl',     'F', 'Main Character', 10, 'Tenshi no Tamago')
    into Characters values('Boy',      'M', 'Main Character', 11, 'Tenshi no Tamago')
    into Person values(300, 'Mamoru Oshii',    'Writer')
    into Person values(301, 'Shigeharu Shiba', 'Artist')
    into Person values(302, 'Mamoru Oshii',  'Director')
    into Person values(303, 'Yoshiyuki Sadamoto', 'Animator')
    into Person values(304, 'Toshio Suzuki', 'Producer')
    into Person values(305, 'Mamoru Oshii', 'Artist')
    into Person values(306, 'Mako Hyoudou',   'Voice Actor')
    into Person values(307, 'Jinpachi Nezu', 'Voice Actor')
    into Writer values(300, 'Mamoru Oshii',    'Writer')
    into Artist values(305, NULL, 'Mamoru Oshii', 'Artist')
    into VoiceActor values(306, 'Mako Hyoudou',   'Voice Actor', 'Japanese')
    into VoiceActor values(307, 'Jinpachi Nezu', 'Voice Actor', 'Japanese')
    into Hires values('Studio Deen', 300)
    into Hires values('Studio Deen', 301)
    into Hires values('Studio Deen', 302)
    into Hires values('Studio Deen', 303)
    into Hires values('Studio Deen', 304)
    into Hires values('Studio Deen', 305)
    into Hires values('Studio Deen', 306)
    into Hires values('Studio Deen', 307)
    into SourceMaterialClassification values('Post-Apocalyptic', 'Adults age 18-44')
    into SourceMaterialClassification values('Drama', 'Women age 17-50')
    into SourceMaterialClassification values('Fantasy', 'Young adults')
    into SourceMaterialInfographics values('Tenshi no Tamago', 300, 'Animation', 'Tokuma Shoten', 1, 1985, 'Tenshi no Tamago')
    into SongRecord values('Prelude', 'Yoshihiro Kanno', 2015, 'Soundtrack')
    into SongType values(3, 'Prelude', 'Ending')
    into Category values('Tenshi no Tamago','Post-Apocalyptic')
    into Category values('Tenshi no Tamago','Drama')
    into Category values('Tenshi no Tamago','Fantasy')
    into Category values('Tenshi no Tamago','Animals')
    into Category values('Tenshi no Tamago','Humans')
    into Category values('Tenshi no Tamago','Urban')
    into Category values('Tenshi no Tamago','Angels')
    into Category values('Tenshi no Tamago','Mystic')
    into Category values('Tenshi no Tamago','Magic')
    into Category values('Tenshi no Tamago','Gothic')
    into Category values('Tenshi no Tamago','Horror')
    into Category values('Tenshi no Tamago','Young Characters')
    into Category values('Tenshi no Tamago','Old Characters')
    into Category values('Tenshi no Tamago','Male Lead')
    into Category values('Tenshi no Tamago','Female Lead')
    into Production values('Tenshi no Tamago', 'Studio Deen', '15 December 1985')
    into Cast values('Tenshi no Tamago', 'Girl',     306)
    into Cast values('Tenshi no Tamago', 'Boy',      307)
select * from dual;

--Tuple 3: short anime #2
insert all
    into Studio values('Brains Base', 'TOKYO Mitaka', 1996)
    into Anime values('Hotarubi no Mori e', 8.3, 'Shoujo', 'Brains Base')
    into Characters values('Gin', 'M', 'Main Character', 16, 'Hotarubi no Mori e')
    into Characters values('Hotaru Takegawa','F', 'Main Character', 16, 'Hotarubi no Mori e')
    into Characters values('Ryouta', 'F', 'Supporting Character', 32, 'Hotarubi no Mori e')
    into Person values(400, 'Yuki Midorikawa', 'Writer')
    into Person values(401, 'Yuki Midorikawa', 'Artist')
    into Person values(402, 'Takahiro Oomori', 'Director')
    into Person values(403, 'Miyake Masanori', 'Producer')
    into Person values(404, 'Kouki Uchiyama',   'Voice Actor')
    into Person values(405, 'Ayane Sakura',  'Voice Actor')
    into Person values(406, 'Hayato Taka',  'Voice Actor')
    into Writer values(400, 'Yuki Midorikawa',    'Writer')
    into Artist values(401, NULL, 'Yuki Midorikawa', 'Artist')
    into VoiceActor values(404, 'Kouki Uchiyama',   'Voice Actor', 'Japanese')
    into VoiceActor values(405, 'Ayane Sakura', 'Voice Actor', 'Japanese')
    into VoiceActor values(406, 'Hayato Taka', 'Voice Actor', 'Japanese')
    into Hires values('Brains Base', 400)
    into Hires values('Brains Base', 401)
    into Hires values('Brains Base', 402)
    into Hires values('Brains Base', 403)
    into Hires values('Brains Base', 404)
    into Hires values('Brains Base', 405)
    into Hires values('Brains Base', 406)
    into SourceMaterialClassification values('Romance', 'Women age 20-70')
    into SourceMaterialInfographics values('Hotarubi no Mori e', 400, 'Manga', 'Tokuma Shoten', 1, 2011, 'Hotarubi no Mori e')
    into SongRecord values('Natsu wo Miteita', 'Shizuru Ootaka', 2012, 'Soundtrack')
    into SongType values(4, 'Natsu wo Miteita', 'Shizuru Ootaka')
    into Category values('Hotarubi no Mori e','Romance')
    into Category values('Hotarubi no Mori e','Magic')
    into Category values('Hotarubi no Mori e','Drama')
    into Category values('Hotarubi no Mori e','Humans')
    into Category values('Hotarubi no Mori e','Animals')
    into Category values('Hotarubi no Mori e','Urban')
    into Category values('Hotarubi no Mori e','Young Characters')
    into Category values('Hotarubi no Mori e','Science Fiction')
    into Category values('Hotarubi no Mori e','Male Lead')
    into Category values('Hotarubi no Mori e','Female Lead')
    into Production values('Hotarubi no Mori e', 'Brains Base', '17 September 2011')
    into Cast values('Hotarubi no Mori e', 'Gin',     404)
    into Cast values('Hotarubi no Mori e', 'Hotaru Takegawa',  405)
    into Cast values('Hotarubi no Mori e', 'Ryouta',  406)
select * from dual;

--Tuple 4: short anime #3
insert all
    into Studio values('CoMix Wave Films', 'TOKYO Chiyoda', 2007)
    into Anime values('Hoshi no Koe', 7.6, 'Seinen', 'CoMix Wave Films')
    into Characters values('Mikako Nagamine', 'M', 'Main Character', 22, 'Hoshi no Koe')
    into Characters values('Noboru Terao','M', 'Main Character', 23, 'Hoshi no Koe')
    into Person values(500, 'Makoto Shinkai', 'Writer')
    into Person values(501, 'Tenmon', 'Artist')
    into Person values(502, 'Steven Foster', 'Director')
    into Person values(503, 'Mizu Sahara', 'Illustrator')
    into Person values(506, 'Makoto Shinkai', 'Producer')
    into Person values(504, 'Sumi Mutou',   'Voice Actor')
    into Person values(505, 'Chihiro Suzuki',  'Voice Actor')
    into Writer values(500, 'Yuki Midorikawa',    'Writer')
    into Artist values(501, NULL, 'Tenmon', 'Artist')
    into VoiceActor values(504, 'Sumi Mutou',   'Voice Actor', 'Japanese')
    into VoiceActor values(505, 'Chihiro Suzuki', 'Voice Actor','Japanese')
    into Hires values('CoMix Wave Films', 500)
    into Hires values('CoMix Wave Films', 501)
    into Hires values('CoMix Wave Films', 502)
    into Hires values('CoMix Wave Films', 503)
    into Hires values('CoMix Wave Films', 504)
    into Hires values('CoMix Wave Films', 505)
    into Hires values('CoMix Wave Films', 506)
    into SourceMaterialClassification values('Slice of Life', 'General')
    into SourceMaterialInfographics values('Hoshi no Koe', 500, 'Manga', 'Kodansha', 1, 2011, 'Hoshi no Koe')
    into SongRecord values('Voices of a Distant Star', 'Tenmon', 2010, 'Soundtrack')
    into SongType values(5, 'Voices of a Distant Star', 'Tenmon')
    into Category values('Hoshi no Koe','Romance')
    into Category values('Hoshi no Koe','Drama')
    into Category values('Hoshi no Koe','Humans')
    into Category values('Hoshi no Koe','Animals')
    into Category values('Hoshi no Koe','Magic')
    into Category values('Hoshi no Koe','Science Fiction')
    into Category values('Hoshi no Koe','Male Lead')
    into Category values('Hoshi no Koe','Female Lead')
    into Category values('Hoshi no Koe','Music')
    into Category values('Hoshi no Koe','Robots')
    into Category values('Hoshi no Koe','Urban')
    into Category values('Hoshi no Koe','Contemporary')
    into Category values('Hoshi no Koe','Space')
    into Category values('Hoshi no Koe','Technology')
    into Category values('Hoshi no Koe','School')
    into Category values('Hoshi no Koe','Young Characters')
    into Production values('Hoshi no Koe', 'CoMix Wave Films', '2 February 2022')
    into Cast values('Hoshi no Koe', 'Mikako Nagamine',     504)
    into Cast values('Hoshi no Koe', 'Noboru Terao',        505)
select * from dual;

--Tuple 5: short anime #5
insert all
    into Studio values('MAPPA', 'TOKYO Suginami City', 2011)
    into Anime values('Takt Op. Destiny', 8.1, 'Teens', 'MAPPA')
    into Characters values('Destiny',     'F', 'Main Character', 20, 'Takt Op. Destiny')
    into Characters values('Takt Asahina',      'M', 'Main Character', 22, 'Takt Op. Destiny')
    into Person values(600, 'Kiyoko Yoshimura',    'Writer')
    into Person values(605, 'Satoru Oshii', 'Artist')
    into Person values(606, 'Tako Hyoudou',   'Voice Actor')
    into Person values(607, 'Jinpachi Nezuko', 'Voice Actor')
    into Writer values(600, 'Kiyoko Yoshimura',    'Writer')
    into Artist values(605, NULL, 'Satoru Oshii', 'Artist')
    into VoiceActor values(606, 'Tako Hyoudou',   'Voice Actor', 'Japanese')
    into VoiceActor values(607, 'Jinpachi Nezuko', 'Voice Actor', 'Japanese')
    into Hires values('MAPPA', 600)
    into Hires values('MAPPA', 605)
    into Hires values('MAPPA', 606)
    into Hires values('MAPPA', 607)
    into SourceMaterialInfographics values('Takt Op. Destiny', 600, 'Animation', 'Bandai', 1, 1985, 'Takt Op. Destiny')
    into SongRecord values('Ballade No. 1', 'Chopin', 2015, 'Soundtrack')
    into SongRecord values('Ballade No. 2', 'Chopin', 2015, 'Soundtrack')
    into SongType values(6, 'Ballade No. 1', 'Opening')
    into SongType values(7, 'Ballade No. 2', 'Ending')
    into Category values('Takt Op. Destiny','Action')
    into Category values('Takt Op. Destiny','Fantasy')
    into Category values('Takt Op. Destiny','Magic')
    into Category values('Takt Op. Destiny','Humans')
    into Category values('Takt Op. Destiny','Animals')
    into Category values('Takt Op. Destiny','Cars')
    into Category values('Takt Op. Destiny','Urban')
    into Category values('Takt Op. Destiny','Female Lead')
    into Category values('Takt Op. Destiny','Male Lead')
    into Category values('Takt Op. Destiny','Young Characters')
    into Category values('Takt Op. Destiny','Old Characters')
    into Production values('Takt Op. Destiny', 'MAPPA', '6 October 2021')
    into Cast values('Takt Op. Destiny', 'Destiny',     606)
    into Cast values('Takt Op. Destiny', 'Takt Asahina',      607)
select * from dual;

-- Tuple 6: short anime #6
insert all
    into Studio values('Bones', 'TOKYO Suginami City', 1998)
    into Anime values('Fullmetal Alchemist', 8.5, 'Teenager', 'Bones')
    into Characters values('Eric Edward', 'M', 'Main Character', 16, 'Fullmetal Alchemist')
    into Characters values('Eric Alphonse', 'M', 'Main Character', 15, 'Fullmetal Alchemist')
    into Person values(800, 'Park Romi', 'Voice Actor')
    into Person values(801, 'Kugimiya Rie', 'Voice Actor')
    into Person values(802, 'Irie Yasuhiro', 'Director')
    into Person values(803, 'Yonai Noritomo', 'Producer')
    into Writer values(804, 'Makoto Inoue', 'Writer')
    into Artist values(805, NULL, 'Hiromu Arakawa', 'Artist')
    into VoiceActor values(800, 'Park Romi', 'Voice Actor', 'Japanese')
    into VoiceActor values(801, 'Kugimiya Rie', 'Voice Actor', 'Japanese')
    into Hires values('Bones', 800)
    into Hires values('Bones', 801)
    into Hires values('Bones', 802)
    into Hires values('Bones', 803)
    into SourceMaterialClassification values('Steampunk', 'General')
    into SourceMaterialInfographics values('Fullmetal Alchemist', 804, 'Manga', 'Square Enix', 27, 2003, 'Fullmetal Alchemist')
    into SongRecord values('Melissa', 'Porno Graffitti', 2003, 'Opening')
    into SongType values(8, 'Melissa', 'Porno Graffitti')
    into Category values('Fullmetal Alchemist', 'Steampunk')
    into Category values('Fullmetal Alchemist', 'Humans')
    into Category values('Fullmetal Alchemist', 'Animals')
    into Category values('Fullmetal Alchemist', 'Urban')
    into Category values('Fullmetal Alchemist', 'Robots')
    into Category values('Fullmetal Alchemist', 'Swordplay')
    into Category values('Fullmetal Alchemist', 'Firearms')
    into Category values('Fullmetal Alchemist', 'Magic')
    into Category values('Fullmetal Alchemist', 'Army')
    into Category values('Fullmetal Alchemist', 'Male Lead')
    into Category values('Fullmetal Alchemist','Young Characters')
    into Category values('Fullmetal Alchemist','Old Characters')
    into Production values('Fullmetal Alchemist', 'Bones', '28 February 2003')
    into Cast values('Fullmetal Alchemist', 'Eric Edward', 800)
    into Cast values('Fullmetal Alchemist', 'Eric Alphonse', 801)
select * from dual;

COMMIT WORK;
