<?php

class User
{
	public string $refreshToken;
	public string $accessToken;
	public string $userId;
	public string $provider;
	public string $email;
	public string $nickname;
	public string $userLanguage;
	/** @var string[] */
	public array $favorite;
	public null $summary;
	public string $profileImageUrl;
	public int $profileImageAspectRatio;
	public string $backgroundImageUrl;
	public int $backgroundImageAspectRatio;
	public int $purpleEnergy;
	public int $pinkEnergy;
	public bool $isPhoneNumberVerified;
	public string $friendCode;
	public bool $allowMarketing;
	public bool $allowGeneralPush;
	public bool $hasFollow;
	public bool $rewardAvailable;
	public int $voteCertificateCount;
	public string $createdAt;
	public bool $hasUnreadNotifications;
	public int $fundingPendingCount;
	public int $fundingCompletedCount;
	public int $pinkBoxCount;
	public int $purpleBoxCount;
	public string $transactionUuid;

	/**
	 * @param string[] $favorite
	 * @param Pick[] $pick
	 */
	public function __construct(
		string $refreshToken,
		string $accessToken,
		string $userId,
		string $provider,
		string $email,
		string $nickname,
		string $userLanguage,
		array $favorite,
		null $summary,
		string $profileImageUrl,
		int $profileImageAspectRatio,
		string $backgroundImageUrl,
		int $backgroundImageAspectRatio,
		int $purpleEnergy,
		int $pinkEnergy,
		bool $isPhoneNumberVerified,
		string $friendCode,
		bool $allowMarketing,
		bool $allowGeneralPush,
		bool $hasFollow,
		bool $rewardAvailable,
		int $voteCertificateCount,
		string $createdAt,
		bool $hasUnreadNotifications,
		int $fundingPendingCount,
		int $fundingCompletedCount,
		int $pinkBoxCount,
		int $purpleBoxCount,
		string $transactionUuid
	) {
		$this->refreshToken = $refreshToken;
		$this->accessToken = $accessToken;
		$this->userId = $userId;
		$this->provider = $provider;
		$this->email = $email;
		$this->nickname = $nickname;
		$this->userLanguage = $userLanguage;
		$this->favorite = $favorite;
		$this->summary = $summary;
		$this->profileImageUrl = $profileImageUrl;
		$this->profileImageAspectRatio = $profileImageAspectRatio;
		$this->backgroundImageUrl = $backgroundImageUrl;
		$this->backgroundImageAspectRatio = $backgroundImageAspectRatio;
		$this->purpleEnergy = $purpleEnergy;
		$this->pinkEnergy = $pinkEnergy;
		$this->isPhoneNumberVerified = $isPhoneNumberVerified;
		$this->friendCode = $friendCode;
		$this->allowMarketing = $allowMarketing;
		$this->allowGeneralPush = $allowGeneralPush;
		$this->hasFollow = $hasFollow;
		$this->rewardAvailable = $rewardAvailable;
		$this->voteCertificateCount = $voteCertificateCount;
		$this->createdAt = $createdAt;
		$this->hasUnreadNotifications = $hasUnreadNotifications;
		$this->fundingPendingCount = $fundingPendingCount;
		$this->fundingCompletedCount = $fundingCompletedCount;
		$this->pinkBoxCount = $pinkBoxCount;
		$this->purpleBoxCount = $purpleBoxCount;
		$this->transactionUuid = $transactionUuid;
	}

	public static function fromJson(\stdClass $data): self
	{
		return new self(
			$data->refreshToken,
			$data->accessToken,
			$data->userId,
			$data->provider,
			$data->email,
			$data->nickname,
			$data->userLanguage,
			$data->favorite,
			$data->summary ?? null,
			$data->profileImageUrl,
			$data->profileImageAspectRatio,
			$data->backgroundImageUrl,
			$data->backgroundImageAspectRatio,
			$data->purpleEnergy,
			$data->pinkEnergy,
			$data->isPhoneNumberVerified,
			$data->friendCode,
			$data->allowMarketing,
			$data->allowGeneralPush,
			$data->hasFollow,
			$data->rewardAvailable,
			$data->voteCertificateCount,
			$data->createdAt,
			$data->hasUnreadNotifications,
			$data->fundingPendingCount,
			$data->fundingCompletedCount,
			$data->pinkBoxCount,
			$data->purpleBoxCount,
			$data->transactionUuid
		);
	}
}
