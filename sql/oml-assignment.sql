INSERT INTO author (authorId, authorBio, authorEmail, authorHash, authorImage, authorName) VALUES(UNHEX(REPLACE("7ee720e5-f1c6-4c9e-b3f3-5150a4853b78", "-", "")), "bio bio bio yadda yadda yadda", "email@domain.io", "", "",
 "Lao Tzu");

INSERT INTO author (authorId,authorBio, authorEmail, authorHash, authorImage, authorName) VALUES(UNHEX(REPLACE("e0b9177d-7a84-4d6c-b95d-b2379ba051c1","-", "")),"","email@mississippi", "", "","Mark Twain");

UPDATE author SET authorName = 'Sun Tzu' WHERE authorName = 'Lao Tzu';
UPDATE author SET authorName = 'Sam Clemens' WHERE authorEmail = 'email@domain.io';

SELECT authorEmail FROM author WHERE authorBio IS NOT NULL;
SELECT authorId FROM author WHERE authorName IS 'Sam Clemens';

DELETE FROM author WHERE authorName = 'Sun Tzu';
DELETE FROM author WHERE authorBio IS NOT NULL;