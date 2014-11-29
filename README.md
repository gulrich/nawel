nawel
=====

**Motivation**

Every year, for Christmas, we make one gift to a randomly picked memeber of the family. However the way we pick the names is problematic. Every year at least one person loses their piece of paper and forget for whom they have to buy a gift. They end up giving a generic gift to the last person without a gift, sad indeed. Furthermore it happens that we pick our own name, in which case we have to start the picking process again, or we pick the same person two (or more) years in a row. Finally it is very difficult to gather everybody before Christmas to pick the names.

**Goal**

The goal of this project is to offer an online version of the Christmas pick a name game. This online solution would not only end the losing paper issue, but it would also facilitate the process of picking names, as it would not be required that everybody is present at the same place and time. Finally we could add additionnal features, such as no picking the same name twice in a row or no picking in someone's own family. 

**Problem**

The main problem with an online solution is to provide an efficient ecryption so that even people having access to the database cannot know who picked who.

**Implementation:**

* [DONE] Create an algorithm to generate the tuples
* Avoid twice in a row tuple, if a tuple already exists (same name as last year) re-generate
  * Be careful if a password was changed during the year, the tuple may be the same but not be encrypted same
  * How about a Christmas day de-encryption of the tuples ?
  * Archive tables with all tuples in plain text with year
* [DONE] Encrypt the generated tuples
* [DONE] Store the encrypted tuples in the database
* [50%] Create an admin space to generate the tuples
  * [50%] Allow the admin to generate the tuples only once a year
  * ? Is a passowrd necessary if it is only possible to generate once a year ?
* Create an user page for everyone to check for whom they have to buy a gift
  * [DONE] Personal page with login base on name + password
  * Specify e-mail address
  * [DONE] Change password
    * [DONE] When password is changed, then we need to re-encrypt the tuple based on the new password
  * [DONE] Reset password
    * [DONE] Create an auto-generated password and send it by e-mail
  * [DONE] Logout
  * Add css to make it look beautiful

**Additionnal features**
* No tuple in one's own family
* Black list of people we don't like (lol)
* List of received gifts and rate them
