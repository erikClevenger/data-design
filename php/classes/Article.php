<?php
// temp fix
require_once ("ValidateUuid.php");
require_once ("ValidateDate.php");
use Ramsey\Uuid\Uuid;

	/**
	 * This is the primary class for articles

	 * This class is a small example of the type of article that may appear on Wired.com
	 * Not all the article components exist here but it can be easily extended to duplicate the format of Wired.com
	 * or other article based publications.
	 *
	 * @article Erik Clevenger erik@modwrk.com
	 * @version 1.0.0
	 *
	 **/

class Article implements \JsonSerializable {

	use \ValidateUuid;
	use \ValidateDate;

	/**
	 * id for this Article; this is the primary key
	 *
	 * @var Uuid $articleId
	 */
	protected $articleId;

	/**
	 * binary of an article's banner image
	 *
	 * @var string $articleBannerImg
	 **/
	protected $articleBannerImg;

	/**
	 * Article text
	 *
	 * @var string $authorContent
	 **/
	protected $articleContent;

	/**
	 * date of article publication
	 *
	 * @var string $articleDate
	 **/
	protected $articleDate;

	/**
	 * Tags for user sorting
	 *
	 * @var string $authorTags
	 **/
	protected $articleTags;

	/**
	 * Author defined article title
	 *
	 * @var string $articleTitle
	 **/
	protected $articleTitle;

	/**
	 *
	 * Constructor for articles
	 *
	 * @param string|Uuid $newArticleId of article
	 * @param string|Uuid $newArticleAuthorId authorId foreign key
	 * @param string| $newArticleBannerImg A string containing the author's bio
	 * @param string| $newArticleContent providing the author's email
	 * @param string| $newArticleDate publication date of an article
	 * @param string| $newArticleTags a string containing the article's tags
	 * @param string| $newArticleTitle a string containing the article title
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 **/

	public function __construct(string $newArticleId, string $newArticleAuthorId, string $newArticleBannerImg, string
	$newArticleContent, string $newArticleDate, string $newArticleTags, string $newArticleTitle) {
	try {
		$this->setAuthorId($newArticleId);
		$this->setArticleAuthorId($newArticleAuthorId);
		$this->setArticleBannerImg($newArticleBannerImg);
		$this->setArticleContent($newArticleContent);
		$this->setArticleDate($newArticleDate);
		$this->setArticleTags($newArticleTags);
		$this->setArticleTitle($newArticleTitle);
		} //identify thrown exceptions
	catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
		$exceptionType = get_class($exception);
		throw(new $exceptionType($exception->getMessage(), 0, $exception));
			}
		}

	/**
	 * Fetches article's Uuid from mySQL
	 * 
	 * @return Uuid
	 */
	public function getArticleId(): Uuid {
		return $this->articleId;
	}
	/**
	 * Sets the article's primary key/ Id number
	 *
	 * @param Uuid $articleId
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 */
	public function setArticleId($articleId): void {
		try {
			$uuid = self::validateUuid($articleId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw new $exceptionType($exception->getMessage(), 0, $exception);
		}

		$this->articleId = $uuid;
	}

	/**
	 * Gets the article's banner image from mySQL
	 * 
	 * @return string
	 */
	public function getArticleBannerImg(): string {
		return $this->articleBannerImg;
	}

	/**
	 * @param string $articleBannerImg
	 */
	//TODO readup on GD to sanitize image data
	
	public function setArticleBannerImg(string $articleBannerImg): void {
		$this->articleBannerImg = $articleBannerImg;
	}

	/**
	 * Get the article's text
	 * 
	 * @return string
	 */
	public function getArticleContent(): string {
		return $this->articleContent;
	}

	/**
	 *Sets the sanitized article text.
	 *
	 * @param string 
	 */
	public function setArticleText(string $newArticleText): void {
		$newArticleText = trim($newArticleText);
		$newArticleText = filter_var($newArticleText, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if (empty($newArticleText) === true) {
			echo "No Bio";
		}
		if (strlen($newArticleText > 140) === true) {
			echo "The bio is too long, try to keep is short and sweet (as in 140 characters).";
		}
		$this->articleText = $newArticleText;
	}

	/**
	 * Gets the article's original publish date
	 *
	 * @return string
	 */
	public function getArticleDate(): string {
		return $this->articleDate;
	}

	/**
	 * Validates and sets the article publish date
	 *
	 * @param string $articleDate
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 */
	public function setArticleDate(string $articleDate): void {
		try {
			$date = self::validateDate($articleDate);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw new $exceptionType($exception->getMessage(), 0, $exception);
		}
		$this->articleDate = $articleDate;
	}

	/**
	 * @return string
	 */
	public function getArticleTags(): string {
		return $this->articleTags;
	}

	/**
	 * @param string $articleTags
	 */
	public function setArticleTags(string $articleTags): void {
		$this->articleTags = $articleTags;
	}

	/**
	 * @return string
	 */
	public function getArticleTitle(): string {
		return $this->articleTitle;
	}

	/**
	 * @param string $articleTitle
	 */
	public function setArticleTitle(string $articleTitle): void {
		$this->articleTitle = $articleTitle;
	}




	public function jsonSerialize() :array {
		$fields = get_object_vars($this);
		unset($fields["articleId"]);
		unset($fields["articleAuthorId"]);

		$fields["articleId"] = $this->articleId->toString();
		return ($fields);
	}
}