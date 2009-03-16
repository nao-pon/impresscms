<?php
/**
 * Extended User Profile
 *
 *
 *
 * @copyright       The ImpressCMS Project http://www.impresscms.org/
 * @license         LICENSE.txt
 * @license			GNU General Public License (GPL) http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @package         modules
 * @since           1.2
 * @author          Jan Pedersen
 * @author          Marcello Brandao <marcello.brandao@gmail.com>
 * @author	   		Sina Asghari (aka stranger) <pesian_stranger@users.sourceforge.net>
 * @version         $Id$
 */

define("_PROFILE_MA_ERRORDURINGSAVE", "Error during save");
define('_PROFILE_MA_USERREG','User Registration');
define('_PROFILE_MA_NICKNAME','Username');
define('_PROFILE_MA_REALNAME', 'Real Name');
define('_PROFILE_MA_EMAIL','Email');
define('_PROFILE_MA_ALLOWVIEWEMAIL','Allow other users to view my email address');
define('_PROFILE_MA_TIMEZONE','Time Zone');
define('_PROFILE_MA_AVATAR','Avatar');
define('_PROFILE_MA_VERIFYPASS','Verify Password');
define('_PROFILE_MA_SUBMIT','Submit');
define('_PROFILE_MA_USERNAME','Username');
define('_PROFILE_MA_USERLOGINNAME','Login name');
define('_PROFILE_MA_FINISH','Finish');
define('_PROFILE_MA_REGISTERNG','Could not register new user.');
define('_PROFILE_MA_MAILOK','Receive occasional email notices <br />from administrators and moderators?');
define('_PROFILE_MA_DISCLAIMER','Disclaimer');
define('_PROFILE_MA_IAGREE','I agree to the above');
define('_PROFILE_MA_UNEEDAGREE', 'Sorry, you have to agree to our disclaimer to get registered.');
define('_PROFILE_MA_NOREGISTER','Sorry, we are currently closed for new user registrations');
define("_PROFILE_MA_NOSTEPSAVAILABLE", "No registration steps are defined");
define("_PROFILE_MA_REQUIRED", "Required");

// %s is username. This is a subject for email
define('_PROFILE_MA_USERKEYFOR','User activation key for %s');
define('_PROFILE_MA_ACTLOGIN','The account has been activated and can now login with the registered password.');
define('_PROFILE_MA_ACTKEYNOT','Activation key not correct!');
define('_PROFILE_MA_ACONTACT','Selected account is already activated!');

define('_PROFILE_MA_YOURREGISTERED','An email containing an user activation key has been sent to the email account you provided. Please follow the instructions in the mail to activate your account. ');
define('_PROFILE_MA_YOURREGMAILNG','You are now registered. However, we were unable to send the activation mail to your email account due to an internal error that had occurred on our server. We are sorry for the inconvenience, please send the webmaster an email notifying him/her of the situation.');
define('_PROFILE_MA_YOURREGISTERED2','You are now registered.  Please wait for your account to be activated by the adminstrators.  You will receive an email once you are activated.  This could take a while so please be patient.');

// %s is your site name
define('_PROFILE_MA_NEWUSERREGAT','New user registration at %s');
// %s is a username
define('_PROFILE_MA_HASJUSTREG','%s has just registered!');

define('_PROFILE_MA_INVALIDMAIL','ERROR: Invalid email');
define('_PROFILE_MA_EMAILNOSPACES','ERROR: Email addresses do not contain spaces.');
define('_PROFILE_MA_INVALIDNICKNAME','ERROR: Invalid Username');
define("_PROFILE_MA_INVALIDDISPLAYNAME", "ERROR: Invalid Displayname");
define('_PROFILE_MA_NICKNAMETOOLONG','Username is too long. It must be less than %s characters.');
define('_PROFILE_MA_DISPLAYNAMETOOLONG','Displayname is too long. It must be less than %s characters.');
define('_PROFILE_MA_NICKNAMETOOSHORT','Username is too short. It must be more than %s characters.');
define('_PROFILE_MA_DISPLAYNAMETOOSHORT','Displayname is too short. It must be more than %s characters.');
define('_PROFILE_MA_NAMERESERVED','ERROR: Name is reserved.');
define('_PROFILE_MA_DISPLAYNAMERESERVED','ERROR: Displayname is reserved.');
define('_PROFILE_MA_NICKNAMENOSPACES','There cannot be any spaces in the Username.');
define('_PROFILE_MA_DISPLAYNAMENOSPACES','There cannot be any spaces in the Displayname.');
define('_PROFILE_MA_NICKNAMETAKEN','ERROR: Username taken.');
define('_PROFILE_MA_DISPLAYNAMETAKEN','ERROR: Displayname taken.');
define('_PROFILE_MA_LOGINNAMETAKEN','ERROR: Loginname taken.');
define('_PROFILE_MA_EMAILTAKEN','ERROR: Email address already registered.');
define('_PROFILE_MA_ENTERPWD','ERROR: You must provide a password.');
define('_PROFILE_MA_SORRYNOTFOUND','Sorry, no corresponding user info was found.');
define("_PROFILE_MA_WRONGPASSWORD", "ERROR: Wrong Password");
define("_PROFILE_MA_USERALREADYACTIVE", "User with email %s is already activated");

// %s is your site name
define('_PROFILE_MA_YOURACCOUNT', 'Your account at %s');

// %s is a username
define('_PROFILE_MA_ACTVMAILNG', 'Failed sending notification mail to %s');
define('_PROFILE_MA_ACTVMAILOK', 'Notification mail to %s sent.');

define("_PROFILE_MA_DEFAULT", "Basic Information");

//%%%%%%		File Name userinfo.php 		%%%%%
define('_PROFILE_MA_SELECTNG','No User Selected! Please go back and try again.');
define('_PROFILE_MA_PM','PM');
define('_PROFILE_MA_EDITPROFILE','Edit Profile');
define('_PROFILE_MA_LOGOUT','Logout');
define('_PROFILE_MA_INBOX','Inbox');
define('_PROFILE_MA_ALLABOUT','All about %s');
define('_PROFILE_MA_STATISTICS','Statistics');
define('_PROFILE_MA_MYINFO','My Info');
define('_PROFILE_MA_BASICINFO','Basic information');
define('_PROFILE_MA_MOREABOUT','More About Me');
define('_PROFILE_MA_SHOWALL','Show All');

//%%%%%%		File Name edituser.php 		%%%%%
define('_PROFILE_MA_PROFILE','Profile');
define('_PROFILE_MA_DISPLAYNAME','Displayname');
define('_PROFILE_MA_SHOWSIG','Always attach my signature');
define('_PROFILE_MA_CDISPLAYMODE','Comments Display Mode');
define('_PROFILE_MA_CSORTORDER','Comments Sort Order');
define('_PROFILE_MA_PASSWORD','Password');
define('_PROFILE_MA_TYPEPASSTWICE','(type a new password twice to change it)');
define('_PROFILE_MA_SAVECHANGES','Save Changes');
define('_PROFILE_MA_NOEDITRIGHT',"Sorry, you don't have the right to edit this user's info.");
define('_PROFILE_MA_PASSNOTSAME','Both passwords are different. They must be identical.');
define('_PROFILE_MA_PWDTOOSHORT','Sorry, your password must be at least <b>%s</b> characters long.');
define("_PROFILE_MA_NOPASSWORD", "Please input a password");
define('_PROFILE_MA_PROFUPDATED','Your Profile Updated!');
define('_PROFILE_MA_USECOOKIE','Store my user name in a cookie for 1 year');
define('_PROFILE_MA_NO','No');
define('_PROFILE_MA_DELACCOUNT','Delete Account');
define('_PROFILE_MA_MYAVATAR', 'My Avatar');
define('_PROFILE_MA_UPLOADMYAVATAR', 'Upload Avatar');
define('_PROFILE_MA_MAXPIXEL','Max Pixels');
define('_PROFILE_MA_MAXIMGSZ','Max Image Size (Bytes)');
define('_PROFILE_MA_SELFILE','Select file');
define('_PROFILE_MA_OLDDELETED','Your old avatar will be deleted!');
define('_PROFILE_MA_CHOOSEAVT', 'Choose avatar from the available list');

define('_PROFILE_MA_PRESSLOGIN', 'Press the button below to login');

define('_PROFILE_MA_ADMINNO', 'User in the webmasters group cannot be removed');
define('_PROFILE_MA_GROUPS', 'User\'s Groups');

define('_PROFILE_MA_NOPERMISS','Sorry, you dont have the permission to perform this action!');
define('_PROFILE_MA_SURETODEL','Are you sure you want to delete your account?');
define('_PROFILE_MA_REMOVEINFO','This will remove all your info from our database.');
define('_PROFILE_MA_BEENDELED','Your account has been deleted.');

//changepass.php
define("_PROFILE_MA_CHANGEPASSWORD", "Change Password");
define("_PROFILE_MA_PASSWORDCHANGED", "Password Changed Successfully");
define("_PROFILE_MA_OLDPASSWORD", "Current Password");
define("_PROFILE_MA_NEWPASSWORD", "New Password");

//search.php
define("_PROFILE_MA_SORTBY", "Sort By");
define("_PROFILE_MA_ORDER", "Order");
define("_PROFILE_MA_PERPAGE", "Users per page");
define("_PROFILE_MA_LATERTHAN", "%s is later than");
define("_PROFILE_MA_EARLIERTHAN", "%s is earlier than");
define("_PROFILE_MA_LARGERTHAN", "%s is larger than");
define("_PROFILE_MA_SMALLERTHAN", "%s is smaller than");

define("_PROFILE_MA_NOUSERSFOUND", "No users found");
define("_PROFILE_MA_RESULTS", "Search Results");

//changemail.php
define("_PROFILE_MA_SENDPM", "Send Email");
define("_PROFILE_MA_CHANGEMAIL", "Change Email");
define("_PROFILE_MA_NEWMAIL", "New Email Address");

define("_PROFILE_MA_NEWEMAILREQ", "New Email Address Request");
define("_PROFILE_MA_NEWMAILMSGSENT", "Your New Email Address Change Request has been received and logged. You must confirm your new email address before your session expires. An email with activation instructions has been sent to the new email address you entered. Please follow the instructions in that email to make the change. Do not close your browser until you click on the confirmation link in the e-mail address. Your email address WILL NOT CHANGE UNLESS you confirm it.");
define("_PROFILE_MA_EMAILCHANGED", "Your Email Address Has Been Changed");

define("_PROFILE_MA_DEACTIVATE", "Deactivate");
define("_PROFILE_MA_ACTIVATE", "Activate");
define("_PROFILE_MA_CONFCODEMISSING", "Confirmation Code Missing");
define("_PROFILE_MA_SITEDEFAULT", "Site default");


define("_PROFILE_MA_USERINFO","User profile");
define("_PROFILE_MA_REGISTER","Registration form");
//Present in many files (videos pictures etc...)
define("_MD_PROFILE_DELETE", "Delete");
define("_MD_PROFILE_EDITDESC", "Edit description");
define("_MD_PROFILE_TOKENEXPIRED", "Your Security Token has Expired<br />Please Try Again");
define("_MD_PROFILE_DESC_EDITED","The description was edited successfully");
define("_MD_PROFILE_CAPTION","Caption");
define("_MD_PROFILE_YOUCANUPLOAD","You can only upload jpg's files and up to %s KBytes in size");
define("_MD_PROFILE_UPLOADPICTURE","Upload Picture");
define("_MD_PROFILE_NOCACHACA","Problem found ... file to big?!<br />
Unfortunately, this module has acted in an unexpected way. Hopefully it will return to its helpful self if you try again. ");//Funny general error message
define("_MD_PROFILE_PAGETITLE","%s - %s's Social Network");
define("_MD_PROFILE_SUBMIT","Submit");
define("_MD_PROFILE_VIDEOS","Videos");
define("_MD_PROFILE_SCRAPBOOK","Scraps");
define("_MD_PROFILE_PHOTOS","Photos");
define("_MD_PROFILE_FRIENDS","Friends");
define("_MD_PROFILE_TRIBES","Tribes");
define("_MD_PROFILE_NOTRIBESYET","No Tribes yet");
define("_MD_PROFILE_MYTRIBES","My Tribes");
define("_MD_PROFILE_ALLTRIBES","All Tribes");
define("_MD_PROFILE_PROFILE","Profile");
define("_MD_PROFILE_HOME","Home");
define("_MD_PROFILE_CONFIGSTITLE","My settings");
define("_MD_EXTENDED_PROFILE","Extra Info");

##################################################### PICTURES #######################################################
//submit.php (for pictures submission
define("_MD_PROFILE_UPLOADED","Upload Successful");

//delpicture.php
define("_MD_PROFILE_ASKCONFIRMDELETION","Are you sure you want to delete this picture?");
define("_MD_PROFILE_CONFIRMDELETION","Yes please delete it!");

//album.php
define("_MD_PROFILE_YOUHAVE", "You have %s picture(s) in your album.");
define("_MD_PROFILE_YOUCANHAVE", "You can have up to %s picture(s).");
define("_MD_PROFILE_DELETED","Image deleted successfully");
define("_MD_PROFILE_SUBMIT_PIC_TITLE","Upload photo");
define("_MD_PROFILE_SELECT_PHOTO","Select Photo");
define("_MD_PROFILE_NOTHINGYET","No pictures in this album yet");
define("_MD_PROFILE_AVATARCHANGE","Make this picture your new avatar");
define("_MD_PROFILE_PRIVATIZE","Only you will see this image in your album");
define("_MD_PROFILE_UNPRIVATIZE","Everyone will be able to see this image in your album");
define("_MD_PROFILE_MYPHOTOS","My Photos");

//avatar.php
define("_MD_PROFILE_AVATAR_EDITED","You changed your avatar!");

//private.php
define("_MD_PROFILE_PRIVATIZED","From now on only you can see this image in your album");
define("_MD_PROFILE_UNPRIVATIZED","From now everyone can see this image in your album");

########################################################## FRIENDS ###################################################
//friends.php
define("_MD_PROFILE_FRIENDSTITLE","%s's Friends");
define("_MD_PROFILE_NOFRIENDSYET","No friends yet");//also present in index.php
define("_MD_PROFILE_MYFRIENDS","My Friends");
define("_MD_PROFILE_FRIENDSHIPCONFIGS","Set the configs of this friendship. Evaluate your friend.");

//class/profilefriendship.php
define("_MD_PROFILE_EDITFRIENDSHIP","Your friendship with this member:");
define("_MD_PROFILE_FRIENDNAME","Username");
define("_MD_PROFILE_LEVEL","Friendship level:");
define("_MD_PROFILE_UNKNOWNACCEPTED","Haven't met accepted");
define("_MD_PROFILE_AQUAITANCE","Acquaintances");//also present in index.php
define("_MD_PROFILE_FRIEND","Friend");//also present in index.php
define("_MD_PROFILE_BESTFRIEND","Best Friend");//also present in index.php
define("_MD_PROFILE_FAN","Fan");//also present in index.php
define("_MD_PROFILE_SEXY","Sexy");//also present in index.php
define("_MD_PROFILE_SEXYNO","Nope");
define("_MD_PROFILE_SEXYYES","Yes");
define("_MD_PROFILE_SEXYALOT","Very much!");
define("_MD_PROFILE_TRUSTY","Trusty");
define("_MD_PROFILE_TRUSTYNO","Nope");
define("_MD_PROFILE_TRUSTYYES","Yes");
define("_MD_PROFILE_TRUSTYALOT","Very much");
define("_MD_PROFILE_COOL","Cool");
define("_MD_PROFILE_COOLNO","Nope");
define("_MD_PROFILE_COOLYES","Yes");
define("_MD_PROFILE_COOLALOT","Very much");
define("_MD_PROFILE_PHOTO","Friend's Photo");
define("_MD_PROFILE_UPDATEFRIEND","Update Friendship");

//editfriendship.php
define("_MD_PROFILE_FRIENDSHIPUPDATED","Friendship Updated");

//submitfriendpetition.php
define("_MD_PROFILE_PETITIONED","A friend request has been sent to this user, Wait until he accepts to have him in your friends list.");
define("_MD_PROFILE_ALREADY_PETITIONED","You have already sent a friendship request to this user or vice-versa <br />, Wait untill he accepts or rejects it or check if he has asked you as a friend visiting your profile page.");

//makefriends.php
define("_MD_PROFILE_FRIENDMADE","Added as a friend!");

//delfriendship.php
define("_MD_PROFILE_FRIENDSHIPTERMINATED","You have broken your friendship with this user!");

############################################ VIDEOS ############################################################
//mainvideo.php
define("_MD_PROFILE_SETMAINVIDEO","This video is selected on your front page from now on");

//video.php
define("_MD_PROFILE_YOUTUBECODE","YouTube code or URL");
define("_MD_PROFILE_ADDVIDEO","Add video");
define("_MD_PROFILE_ADDFAVORITEVIDEOS","Add favourite videos");
define("_MD_PROFILE_ADDVIDEOSHELP","If you want to upload your own video for sharing, then upload your videos to 
<a href=http://www.youtube.com>YouTube</a> and then add the URL to here "); //The name of the site will show after this
define("_MD_PROFILE_MYVIDEOS","My Videos");
define("_MD_PROFILE_MAKEMAIN","Make this video your main video");
define("_MD_PROFILE_NOVIDEOSYET","No videos yet!");

//delvideo.php
define("_MD_PROFILE_ASKCONFIRMVIDEODELETION","Are you sure you want to delete this video?");
define("_MD_PROFILE_CONFIRMVIDEODELETION","Yes I am!");
define("_MD_PROFILE_VIDEODELETED","Your video was deleted");

//video_submited.php
define("_MD_PROFILE_VIDEOSAVED","Your video was saved");

############################## TRIBES ########################################################
//class/profile_tribes.php
define("_MD_PROFILE_SUBMIT_TRIBE","Create a new tribe");
define("_MD_PROFILE_UPLOADTRIBE","Save Tribe");//also present in many ther tribes related
define("_MD_PROFILE_TRIBE_IMAGE","Tribe Image");//also present in many ther tribes related
define("_MD_PROFILE_TRIBE_TITLE","Title");//also present in many ther tribes related
define("_MD_PROFILE_TRIBE_DESC","Description");//also present in many ther tribes related
define("_MD_PROFILECREATEYOURTRIBE","Create your own Tribe!");//also present in many ther tribes related

//abandontribe.php
define("_MD_PROFILE_ASKCONFIRMABANDONTRIBE","Are you sure you want to leave this Tribe?");
define("_MD_PROFILE_CONFIRMABANDON","Yes please remove me from this Tribe!");
define("_MD_PROFILE_TRIBEABANDONED","You don't belong to this Tribe anymore.");

//becomemembertribe.php
define("_MD_PROFILE_YOUAREMEMBERNOW","You are now member of this community");
define("_MD_PROFILE_YOUAREMEMBERALREADY","You are already a member of this Tribe");

//delete_tribe.php
define("_MD_PROFILE_ASKCONFIRMTRIBEDELETION","Are you sure you want to delete this Tribe permanently?");
define("_MD_PROFILE_CONFIRMTRIBEDELETION","Yes, please delete this Tribe!");
define("_MD_PROFILE_TRIBEDELETED","Tribe deleted!");

//edit_tribe.php
define("_MD_PROFILE_MAINTAINOLDIMAGE","Keep this image");//also present in other tribes related
define("_MD_PROFILE_TRIBEEDITED","Tribe edited");
define("_MD_PROFILE_EDIT_TRIBE","Edit your Tribe");//also present in other tribes related
define("_MD_PROFILE_TRIBEOWNER","You are the owner of this Tribe!");//also present in other tribes related
define("_MD_PROFILE_MEMBERSDOFTRIBE","Members of Tribe");//also present in other tribes related

//submit_tribe.php
define("_MD_PROFILE_TRIBE_CREATED","Your Tribe was created");

//kickfromtribe.php
define("_MD_PROFILE_CONFIRMKICK","Yes kick him out!");
define("_MD_PROFILE_ASKCONFIRMKICKFROMTRIBE","Are you sure you want to kick this person out of the Tribe?");
define("_MD_PROFILE_TRIBEKICKED","You've banished this user from the Tribe, but who knows when he'll try and comeback!");

//Tribes.php
define("_MD_PROFILE_TRIBE_ABANDON","Leave this Tribe");
define("_MD_PROFILE_TRIBE_JOIN","Join this Tribe and show everyone who you are!");
define("_MD_PROFILE_TRIBE_SEARCH","Search a Tribe");
define("_MD_PROFILE_TRIBE_SEARCHKEYWORD","Keyword");

######################################### SCRAPS #####################################################
//scrapbook.php
define('_MD_PROFILE_ENTERTEXTSCRAP',"Enter Text or BB-Codes");
define("_MD_PROFILE_SENDSCRAP","post Scrap");
define("_MD_PROFILE_ANSWERSCRAP","Reply");//also present in configs.php
define("_MD_PROFILE_MYSCRAPBOOK","My Scrapbook");
define("_MD_PROFILE_CANCEL","Cancel");//also present in configs.php
define("_MD_PROFILE_SCRAPTIPS","Scrap tips");
define("_MD_PROFILE_BOLD","bold");
define("_MD_PROFILE_ITALIC","italic");
define("_MD_PROFILE_UNDERLINE","underline");
define("_MD_PROFILE_NOSCRAPSYET","No Scraps created in this Scrapbook yet");

//submit_scrap.php
define("_MD_PROFILE_SCRAP_SENT","Thanks for participating, Scrap sent");

//delete_scrap.php
define("_MD_PROFILE_ASKCONFIRMSCRAPDELETION","Are you sure you want to delete this Scrap?");
define("_MD_PROFILE_CONFIRMSCRAPDELETION","Yes please delete this Scrap.");
define("_MD_PROFILE_SCRAPDELETED","The Scrap was deleted");

############################ CONFIGS ##############################################
//configs.php
define("_MD_PROFILE_CONFIGSEVERYONE","Everyone");
define("_MD_PROFILE_CONFIGSONLYEUSERS","Only Registered Members");
define("_MD_PROFILE_CONFIGSONLYEFRIENDS","My friends.");
define("_MD_PROFILE_CONFIGSONLYME","Only Me");
define("_MD_PROFILE_CONFIGSPICTURES","See your Photos");      
define("_MD_PROFILE_CONFIGSVIDEOS","See your Videos"); 
define("_MD_PROFILE_CONFIGSTRIBES","See your Tribes"); 
define("_MD_PROFILE_CONFIGSSCRAPS","See your Scraps"); 
define("_MD_PROFILE_CONFIGSSCRAPSSEND","Send you Scraps");
define("_MD_PROFILE_CONFIGSFRIENDS","See your Friends");
define("_MD_PROFILE_CONFIGSPROFILECONTACT","See your contact info"); 
define("_MD_PROFILE_CONFIGSPROFILEGENERAL","See your Info"); 
define("_MD_PROFILE_CONFIGSPROFILESTATS","See your Stats");
define("_MD_PROFILE_WHOCAN","Who can:");

//submit_configs.php
define("_MD_PROFILE_CONFIGSSAVE","Configuration saved!");

//class/profile_controler.php
define("_MD_PROFILE_NOPRIVILEGE","The owner of this profile has set the privileges to see it, <br />higher than you have now. <br />Login to become their friend. <br />If they haven't set it, so only they can see, <br />then you will be able to view it.");

###################################### OTHERS ##############################

//index.php
define("_MD_PROFILE_VISITORS","Visitors (who visited your profile recently)");
define("_MD_PROFILE_USERDETAILS","User details");
define("_MD_PROFILE_USERCONTRIBUTIONS","User contributions");
define("_MD_PROFILE_FANS","Fans");
define("_MD_PROFILE_UNKNOWNREJECTING","I don't know this person, Do not add them to my friends list");
define("_MD_PROFILE_UNKNOWNACCEPTING","I don't know this person, Yet add them to my friends list");
define("_MD_PROFILE_ASKINGFRIEND","Is %s your friend?");
define("_MD_PROFILE_ASKBEFRIEND","Ask this user to be your friend?");
define("_MD_PROFILE_EDITPROFILE","Edit your profile");
define("_MD_PROFILE_SELECTAVATAR","Upload pictures to your album and select one as your avatar.");
define("_MD_PROFILE_SELECTMAINVIDEO","Add a video to your videos album and then select it as your main video");
define("_MD_PROFILE_NOAVATARYET","No avatar yet");
define("_MD_PROFILE_NOMAINVIDEOYET","No main video yet");
define("_MD_PROFILE_MYPROFILE","My Profile");
define("_MD_PROFILE_YOUHAVEXPETITIONS","You have %u requests for friendship.");
define("_MD_PROFILE_CONTACTINFO","Contact Info");
define("_MD_PROFILE_SUSPENDUSER","Suspend user");
define("_MD_PROFILE_SUSPENDTIME","Time of suspension(in secs)");
define("_MD_PROFILE_UNSUSPEND","Unsuspend User");
define("_MD_PROFILE_SUSPENSIONADMIN","Suspension Admin Tools");

//suspend.php
define("_MD_PROFILE_SUSPENDED","User under suspension until %s");
define("_MD_PROFILE_USERSUSPENDED","User suspended!");//als0 present in index.php

//unsuspend.php
define("_MD_PROFILE_USERUNSUSPENDED","User Unsuspended");

//searchmembers.php
define("_MD_PROFILE_SEARCH","Search Members");
define("_MD_PROFILE_AVATAR","Avatar");
define("_MD_PROFILE_REALNAME","Real Name");
define("_MD_PROFILE_REGDATE","Joined Date");
define("_MD_PROFILE_EMAIL","Email");
define("_MD_PROFILE_PM","PM");
define("_MD_PROFILE_URL","URL");
define("_MD_PROFILE_ADMIN","ADMIN");
define("_MD_PROFILE_PREVIOUS","Previous");
define("_MD_PROFILE_NEXT","Next");
define("_MD_PROFILE_USERSFOUND","%s member(s) found");
define("_MD_PROFILE_TOTALUSERS", "Total: %s members");
define("_MD_PROFILE_NOFOUND","No Members Found");
define("_MD_PROFILE_UNAME","User Name");
define("_MD_PROFILE_ICQ","ICQ Number");
define("_MD_PROFILE_AIM","AIM Handle");
define("_MD_PROFILE_YIM","YIM Handle");
define("_MD_PROFILE_MSNM","MSNM Handle");
define("_MD_PROFILE_LOCATION","Location contains");
define("_MD_PROFILE_OCCUPATION","Occupation contains");
define("_MD_PROFILE_INTEREST","Interest contains");
define("_MD_PROFILE_URLC","URL contains");
define("_MD_PROFILE_LASTLOGMORE","Last login is more than <span style='color:#ff0000;'>X</span> days ago");
define("_MD_PROFILE_LASTLOGLESS","Last login is less than <span style='color:#ff0000;'>X</span> days ago");
define("_MD_PROFILE_REGMORE","Joined date is more than <span style='color:#ff0000;'>X</span> days ago");
define("_MD_PROFILE_REGLESS","Joined date is less than <span style='color:#ff0000;'>X</span> days ago");
define("_MD_PROFILE_POSTSMORE","Number of Posts is greater than <span style='color:#ff0000;'>X</span>");
define("_MD_PROFILE_POSTSLESS","Number of Posts is less than <span style='color:#ff0000;'>X</span>");
define("_MD_PROFILE_SORT","Sort by");
define("_MD_PROFILE_ORDER","Order");
define("_MD_PROFILE_LASTLOGIN","Last login");
define("_MD_PROFILE_POSTS","Number of posts");
define("_MD_PROFILE_ASC","Ascending order");
define("_MD_PROFILE_DESC","Descending order");
define("_MD_PROFILE_LIMIT","Number of members per page");
define("_MD_PROFILE_RESULTS", "Search results");

//26/10/2007
define("_MD_PROFILE_VIDEOSNOTENABLED", "The administrator of the site has disabled videos feature");
define("_MD_PROFILE_FRIENDSNOTENABLED", "The administrator of the site has disabled friends feature");
define("_MD_PROFILE_TRIBESNOTENABLED", "The administrator of the site has disabled tribes feature");
define("_MD_PROFILE_PICTURESNOTENABLED", "The administrator of the site has disabled pictures feature");
define("_MD_PROFILE_SCRAPSNOTENABLED", "The administrator of the site has disabled scraps feature");

//26/01/2008
define("_MD_PROFILE_ALLFRIENDS" , "View all friends");
//define("_MD_PROFILE_ALLTRIBES" , "View all tribes");

//31/01/2008
define("_MD_PROFILE_FRIENDSHIPNOTACCEPTED" , "Friendship rejected");

//07/04/2008
define("_MD_PROFILE_USERDOESNTEXIST","This user doesn't exist or was deleted");
define("_MD_PROFILE_FANSTITLE","%s's Fans");
define("_MD_PROFILE_NOFANSYET","No fans yet");

//17/04/2008
define("_MD_PROFILE_AUDIONOTENABLED","The administrator of the site has disabled audio feature");
define("_MD_PROFILE_NOAUDIOYET","This user hasn't uploaded any audio files yet");
define("_MD_PROFILE_AUDIOS","Audio");
define("_MD_PROFILE_CONFIGSAUDIOS","See your Audio files");
define("_MD_PROFILE_UPLOADEDAUDIO","Audio file uploaded");

define("_MD_PROFILE_SELECTAUDIO","Browse for your mp3 file");
define("_MD_PROFILE_AUTHORAUDIO","Author/Singer");
define("_MD_PROFILE_TITLEAUDIO","Title of file or song");
define("_MD_PROFILE_ADDAUDIO","Add an mp3 file");
define("_MD_PROFILE_SUBMITAUDIO","Upload file");
define("_MD_PROFILE_ADDAUDIOHELP","Choose an mp3 file on your computer, max size %s ,<br /> Leave title and author fields blank if your file has metainfo already");

//19/04/2008
define("_MD_PROFILE_AUDIODELETED","Your mp3 file was deleted!");
define("_MD_PROFILE_ASKCONFIRMAUDIODELETION","Do you really want to delete your audio file?");
define("_MD_PROFILE_CONFIRMAUDIODELETION","Yes please delete it!");

define("_MD_PROFILE_META","Meta Info");
define("_MD_PROFILE_META_TITLE","Title");
define("_MD_PROFILE_META_ALBUM","Album");
define("_MD_PROFILE_META_ARTIST","Artist");
define("_MD_PROFILE_META_YEAR","Year");

// v3.3RC2
define("_MD_PROFILE_PLAYER","Your audio player");
?>