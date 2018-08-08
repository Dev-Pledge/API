<?php

namespace DevPledge\Domain;

/**
 * Class Solution
 * @package DevPledge\Domain
 */
class Solution extends AbstractDomain {
	/**
	 * @var string
	 */
	protected $solutionGroupId;
	/**
	 * @var string
	 */
	protected $problemSolutionGroupId;
	/**
	 * @var string
	 */
	protected $userId;
	/**
	 * @var string
	 */
	protected $problemId;
	/**
	 * @var string
	 */
	protected $openSourceLocation;

	/**
	 * @return \stdClass
	 */
	function toPersistMap(): \stdClass {
		return (object) [
			'solution_id' => $this->getId()
		];
	}

	/**
	 * @return null|string
	 */
	public function getSolutionGroupId(): ?string {
		return $this->solutionGroupId;
	}

	/**
	 * @param string $solutionGroupId
	 *
	 * @return Solution
	 */
	public function setSolutionGroupId( string $solutionGroupId ): Solution {
		$this->solutionGroupId = $solutionGroupId;

		return $this;
	}

	/**
	 * @param string $problemSolutionGroupId
	 *
	 * @return Solution
	 */
	public function setProblemSolutionGroupId( string $problemSolutionGroupId ): Solution {
		$this->problemSolutionGroupId = $problemSolutionGroupId;

		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getProblemSolutionGroupId(): ?string {
		return $this->problemSolutionGroupId;
	}

	/**
	 * @param string $userId
	 *
	 * @return Solution
	 */
	public function setUserId( string $userId ): Solution {
		$this->userId = $userId;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getUserId(): string {
		return $this->userId;
	}

	/**
	 * @param string $problemId
	 *
	 * @return Solution
	 */
	public function setProblemId( string $problemId ): Solution {
		$this->problemId = $problemId;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getProblemId(): string {
		return $this->problemId;
	}

	/**
	 * @param string $openSourceLocation
	 *
	 * @return Solution
	 */
	public function setOpenSourceLocation( string $openSourceLocation ): Solution {
		$this->openSourceLocation = $openSourceLocation;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getOpenSourceLocation(): string {
		return $this->openSourceLocation;
	}
}