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
	 * @return uuid
	 */
	public function getAuthorID(): uuid {
		return ($this->authorID);
	}

	/**
	 * @param uuid $authorID
	 */
	public function setAuthorID(uuid $authorID): void {
		$this->authorID = $authorID;
	}

	/**
	 * @return string
	 */
	public function getAuthorBio(): string {
		return ($this->authorBio);
	}

	/**
	 * @param string $authorBio
	 */
	public function setAuthorBio(string $authorBio): void {
		$this->authorBio = $authorBio;
	}

	/**
	 * @return string
	 */
	public function getAuthorEmail(): string {
		return ($this->authorEmail);
	}

	/**
	 * @param string $authorEmail
	 */
	public function setAuthorEmail(string $authorEmail): void {
		$this->authorEmail = $authorEmail;
	}

	/**
	 * @return string
	 */
	public function getAuthorHash(): char {
		return ($this->authorHash);
	}

	/**
	 * @param string $authorHash
	 */
	public function setAuthorHash(char $authorHash): void {
		$this->authorHash = $authorHash;
	}

	/**
	 * @return string
	 */
	public function getAuthorImage(): longblob {
		return ($this->authorImage);
	}

	/**
	 * @param string $authorImage
	 */
	public function setAuthorImage(longblob $authorImage): void {
		$this->authorImage = $authorImage;
	}

	/**
	 * @return string
	 */
	public function getAuthorName(): varchar {
		return ($this->authorName);
	}

	/**
	 * @param string $authorName
	 */
	public function setAuthorName(varchar $authorName): void {
		$this->authorName = $authorName;
	}


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

$markTwain = new Author();

$markTwain->setAuthorName("Sam Clemens");
$markTwain->setAuthorEmail("boat@mississippi.net");

echo $markTwain->getAuthorEmail() . $markTwain->getAuthorName();