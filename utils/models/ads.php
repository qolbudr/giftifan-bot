<?php

class Ads
{
	public string $adType;
	public string $qdata;
	/** @var AdNetworks[] */
	public array $adNetworks;
	public string $requestId;
	public string $backendQueryId;

	/**
	 * @param AdNetworks[] $adNetworks
	 */
	public function __construct(
		string $adType,
		string $qdata,
		array $adNetworks,
		string $requestId,
		string $backendQueryId
	) {
		$this->adType = $adType;
		$this->qdata = $qdata;
		$this->adNetworks = $adNetworks;
		$this->requestId = $requestId;
		$this->backendQueryId = $backendQueryId;
	}

	public static function fromJson(\stdClass $data): self
	{
		return new self(
			$data->ad_type,
			$data->qdata,
			array_map(static function($data) {
				return AdNetworks::fromJson($data);
			}, $data->ad_networks),
			$data->request_id,
			$data->backend_query_id
		);
	}
}

class AdNetworks
{
	public string $adNetworkTimeoutMillis;
	public string $adSourceId;
	public string $adSourceInstanceId;
	public string $adSourceInstanceName;
	public string $adSourceName;
	/** @var string[]|null */
	public ?array $adapterClassNames;
	/** @var string[] */
	public array $adapters;
	public string $allocationId;
	public int|float $boostedCpmBidUsdMinusRevenueSharing;
	/** @var string[] */
	public array $fillUrls;
	public string $id;
	/** @var string[]|null */
	public ?array $impUrls;
	/** @var string[] */
	public array $lateLoadUrls;
	/** @var string[] */
	public array $presentationErrorUrls;
	public string $ruleLineExternalId;
	/** @var string[] */
	public array $videoCompleteUrls;
	/** @var string[] */
	public array $videoRewardUrls;
	/** @var string[] */
	public array $videoStartUrls;

	/**
	 * @param string[]|null $adapterClassNames
	 * @param string[] $adapters
	 * @param string[] $fillUrls
	 * @param string[]|null $impUrls
	 * @param string[] $lateLoadUrls
	 * @param string[] $presentationErrorUrls
	 * @param string[] $videoCompleteUrls
	 * @param string[] $videoRewardUrls
	 * @param string[] $videoStartUrls
	 */
	public function __construct(
		string $adNetworkTimeoutMillis,
		string $adSourceId,
		string $adSourceInstanceId,
		string $adSourceInstanceName,
		string $adSourceName,
		?array $adapterClassNames,
		array $adapters,
		string $allocationId,
		int|float $boostedCpmBidUsdMinusRevenueSharing,
		array $fillUrls,
		string $id,
		?array $impUrls,
		array $lateLoadUrls,
		array $presentationErrorUrls,
		string $ruleLineExternalId,
		array $videoCompleteUrls,
		array $videoRewardUrls,
		array $videoStartUrls,
	) {
		$this->adNetworkTimeoutMillis = $adNetworkTimeoutMillis;
		$this->adSourceId = $adSourceId;
		$this->adSourceInstanceId = $adSourceInstanceId;
		$this->adSourceInstanceName = $adSourceInstanceName;
		$this->adSourceName = $adSourceName;
		$this->adapterClassNames = $adapterClassNames;
		$this->adapters = $adapters;
		$this->allocationId = $allocationId;
		$this->boostedCpmBidUsdMinusRevenueSharing = $boostedCpmBidUsdMinusRevenueSharing;
		$this->fillUrls = $fillUrls;
		$this->id = $id;
		$this->impUrls = $impUrls;
		$this->lateLoadUrls = $lateLoadUrls;
		$this->presentationErrorUrls = $presentationErrorUrls;
		$this->ruleLineExternalId = $ruleLineExternalId;
		$this->videoCompleteUrls = $videoCompleteUrls;
		$this->videoRewardUrls = $videoRewardUrls;
		$this->videoStartUrls = $videoStartUrls;
	}

	public static function fromJson(\stdClass $data): self
	{
		return new self(
			$data->ad_network_timeout_millis,
			$data->ad_source_id,
			$data->ad_source_instance_id,
			$data->ad_source_instance_name,
			$data->ad_source_name,
			$data->adapter_class_names ?? null,
			$data->adapters,
			$data->allocation_id,
			$data->boosted_cpm_bid_usd_minus_revenue_sharing,
			$data->fill_urls,
			$data->id,
			$data->imp_urls ?? null,
			$data->late_load_urls,
			$data->presentation_error_urls,
			$data->rule_line_external_id,
			$data->video_complete_urls,
			$data->video_reward_urls,
			$data->video_start_urls,
		);
	}
}