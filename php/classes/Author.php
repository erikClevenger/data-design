<?php
/**
 * Created by PhpStorm.
 * User: erik
 * Date: 4/19/18
 * Time: 9:39 AM
 */

/**
 * This is the primary profile type for authors
 *
 * This profile is a small example of the type of profile that may br created for Authors of articles on Wired.com
 * Not all parts of the profile exist here but it can be easily extended to emulate the format of Wired.com
 * or other article based publications.
 *
 * @author Erik Clevenger erik@modwrk.com
 * @version 1.0.0
 *
 **/

class Author implements \JsonSerializable {

	/**
	 * id for this Author; this is the primary key
	 * @var uuid $authorID
	 *
	 **/
	private $authorID;

	/**
	 * a brief section of information about the author of an article
	 * @var string $authorBio
	 **/
	private $authorBio;

	/**
	 * the author's email address used for authentication NOT to be confused with a public facing email for contact.
	 * This must be unique
	 * @var string $authorEmail
	 **/
	private $authorEmail;

	/**
	 * The hash used for password encryption; user authentication
	 * @var char(97) $authorHash
	 **/
	private $authorHash;

	/**
	 * A profile image of the author to be displayed with the author's bio
	 * @var longblob $authorImage
	 **/
	private $authorImage;

	/**
	 * The author's name as opposed to a user handle
	 * @var varchar(32) $authorName
	 **/
	private $authorName;

	/**
	 * Specify data which should be serialized to JSON
	 * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
	 * @return mixed data which can be serialized by <b>json_encode</b>,
	 * which is a value of any type other than a resource.
	 * @since 5.4.0
	 */
	public function jsonSerialize() {
		// TODO: Implement jsonSerialize() method.
	}
}