<?php

require_once 'vendor/autoload.php';
require_once 'utils/models/user.php';
require_once 'utils/models/ads.php';

use GuzzleHttp\Client;

class Giftifan
{
  private Client $client;
  public ?User $user = null;

  public function __construct(string $email, string $password)
  {
    $this->client = new Client();
    $this->login($email, $password);
  }

  private function getHeaders(bool $withAuth = false): array
  {
    $options['headers']['app-version'] = '2.31.1';
    $options['headers']['device-os'] = 'android';

    if ($withAuth && $this->user) {
      $options['headers']['Authorization'] = 'Bearer ' . $this->user->accessToken;
    }

    return $options;
  }

  private function login(string $email, string $password): void
  {
    try {
      $options = $this->getHeaders();
      $options['form_params']['email'] = $email;
      $options['form_params']['provider'] = 'credentials';
      $options['form_params']['providerSub'] = $password;

      $response = $this->client->post('https://api.giftifan.com/api/auth/login', $options);
      $data = json_decode($response->getBody()->getContents());
      $user = User::fromJson($data);
      $this->user = $user;
    } catch (Exception $e) {
      throw $e;
    }
  }

  public function attendance(): void
  {
    try {
      $options = $this->getHeaders(true);
      $this->client->post('https://api.giftifan.com/api/mission/attendance', $options);
    } catch (Exception $e) {
      throw new Exception('error checking attendance');
    }
  }

  public function getRewardUrl(): string {
    try {
      $options['headers']['User-Agent'] = 'Mozilla/5.0 (Linux; Android 12; SM-W2022 Build/SP1A.210812.016; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/91.0.4472.114 Mobile Safari/537.36 (Mobile; afma-sdk-a-v252431029.252431029.0)';
      $response = $this->client->get('https://googleads.g.doubleclick.net/mads/gma?submodel=VER-AN00&adid_p=1&format=interstitial_mb&ini_pn=com.android.vending&ins_pn=com.android.vending&omid_v=a.1.5.2-google_20241009&dv=251815204&ev=23.4.0&gl=US&hl=en&js=afma-sdk-a-v251815999.243220000.1&lv=243220703&ms=CpgECoACnJkF-xbrK1FSlPaob5g_43e341bp8xmazF0wUQ-EaTdJHk9nP-IyRLMwZGMR6gHvaCMRE9K2vXJ2te3s0G9b0mq2sikEkjdivRWQ1jfCdjEwVGKQf3NIAzTDYipM2WhVlkWe-vod6sGvCxBWJLxkDfdzFK3aBSFyU-2ZCANs7Q_s7LwCUY4mGk6Ywy-WaDqN7vtkWCZx25oPAI9e2vf1tgNmRP3zE0dl0w1E-olKk4JJuUs_ilPN3yLTgbeIcOF3y6ZAmJ-BJK9K2utL4kDCkPFXhctO9bElFgb7K6ViI_h_zg_TMLsqeDAZ9tjHtv3ljolkfX536-pIZw3n-kSDwQqAAnkS3YG44c6tr2XDn19l69WeqsyUSzHtEutU5XPErCOLt_o7rWrxLusp6RHxFa8gv3tw8rAj8Zl37Paln2ri_DaGdMhe9_RNuEcFynIhmGi1fmtaXawQ2v8HHwt_zHy7MxzuToYi88Tc2XW8p97zk_D71Lj-kdlnNnOwSibkrqn1C9cnXTi4vT00KLkqgqJcGz2Tv4Ec2WqzroRGtHQybds0YQ3YI5WRSSJkEQeJsqx-MhsbcrqO-Vz7uqGkN-9JMvh61UPnqt0GTuyqpZKNPpvacc6bD4GJX0aI1hV3-A3wuzugGgTac8j3pjjt6ptwz5YcmR7AWRE5qNuWSYTFAN8SEJWH6n_kQlBDFGR2x-fl4GUSlQIKgAKJjlVAEBneMpl_h02xkCF7Qu45aXBgHfFX0B7utGByfVypo9uS_j7SwpGEb8Kwz72r3BXNGrC8RxS4LpcPt7J9x36SIIGlb4riR-YvX7OX6mgzItUaiJup4gl9HTARL5dFnpmO0sg-xgEnZ3uWK44KI1Te3TToUn5uOwLbn0_NhP8ndIaFwHeCAdLfFX9iWLVmYI1VkVUzidQALzbBwZoqPnRegnQTfbk8JZ34h55AI7WWU7UcbecclnBYU_dV5ZBW9W35aYzYh7-x34C-wINPC1LKzYI4VFNikeqhqUy_9odRDvLeePtZcJI7CfbnTfmw_1XKOwZn8Y6Hzr0y56LOEhBZ7hz9BraeQbzwSwKJR-o5&mv=84751930.com.android.vending&lft=1&vnm=2.31.1&u_sd=1.875&request_id=330759106&target_api=35&carrier=46000&request_agent=Flutter-GMA-5.2.0&fbs_aeid=3738590039180496578&fbs_aiid=6a698646a770d2af485d659ef98c8146&seq_num=2&eid=318500618%2C318486317%2C318491267%2C318483611%2C318484496%2C318519886%2C318522592%2C318503827%2C318509850%2C318514154%2C318515634%2C318521780%2C318522226%2C318522351%2C318521809%2C318516088&guci=0.0.0.0.0.0.0.0&sdk_apis=7%2C8&omid_p=Google%2Fafma-sdk-a-v251815999.243220000.1&cap=m&u_w=480&u_h=854&msid=com.sky.giftifan&an=2025042301.android.com.sky.giftifan&dvoln=1&u_audio=1&net=wi&u_so=p&rbv=1&loeid=44766145%2C318502621&iotex=1&preqs_in_session=1&preqs=1&time_in_session=371030&pcc=1&dload=2057&pcl=5120&pseq_nums=1&sst=1755868020000&output=html&region=mobile_app&u_tz=480&client=ca-app-pub-8520438203987575&slotname=4117403740&gsb=wi&apm_app_id=1%3A313415902184%3Aandroid%3A3b234170ee4b90d79c7a5d&gmp_app_id=1%3A313415902184%3Aandroid%3A3b234170ee4b90d79c7a5d&apm_app_type=1&lite=0&app_wp_code=ca-app-pub-8520438203987575&app_code=8953313596&num_ads=1&vpt=8&vfmt=18&vst=0&sdkv=o.251815999.243220000.1&sdmax=0&dmax=1&sdki=3c4d&stbg=1&bisch=true&blev=0.82&canm=false&_mv=32.android&heap_free=12948174&heap_max=201326592&heap_total=44172782&wv_count=2&rdps=118500&is_lat=false&blob=ABPQqLFYE9oUbwN8dWSreL_qzsjqzyQWjWw6lZyq5xymY0ZtbrE6Wr1V6edS70KTmxyv8g9kZ2PJPMdDmYiwCIwEMe-MGyaokj1zoVDVCncxcn3i8hd8EC7obXOl26P_01deLTmb9T5XaVzcDqdQQSjYo5bMICaauN-Zt6xfnkDsSBjqJgBbxmRJpJP8LB5gg9WVSmfCoQbKsw9eWICW31HfA0Ae5t9gFIse7jog-HPeSDgGj_sQxNUF3Sp-VlSYGvd0PN7mgI8LhnimkfBnYTWOj6bJqQjcK3o6X9VUAwi-zjMSkIzjK9Eu0Ihwj_iUMH-T5mZZpXuzVgCL-8ND2mvhLcT9GF8_iWf3p7Z4oi-a5oGxv_sP7NjBe3w_qbk82k1jl2jAOhnyVc8PL7fK2kI4VSIpTam_IMFtmZjeVdclAVALKbuNoYWKv0hK5g&capsbf=7FFFFFEE&a3p=Cl4qNmNvbS5nb29nbGUuYWRzLm1lZGlhdGlvbi52dW5nbGUuVnVuZ2xlTWVkaWF0aW9uQWRhcHRlcjoiIAEqHkFkYXB0ZXIgZmFpbGVkIHRvIGluc3RhbnRpYXRlLlABCl4qNmNvbS5nb29nbGUuYWRzLm1lZGlhdGlvbi5wYW5nbGUuUGFuZ2xlTWVkaWF0aW9uQWRhcHRlcjoiIAEqHkFkYXB0ZXIgZmFpbGVkIHRvIGluc3RhbnRpYXRlLlAB&mr_itag=1766913684636504001_140_247~-3254808194158773253_140_247~-6933060207135336292_140_247&jsv=sdk_20190107_RC02-production-sdk_20250811_RC00', $options);
      $data = json_decode($response->getBody());
      $ads = Ads::fromJson($data);
      $url = "";

      foreach($ads->adNetworks as $adNetwork) {
        foreach ($adNetwork->videoRewardUrls as $videoRewardUrl) {
          if (str_contains($videoRewardUrl, "pburl")) {
            $url = $videoRewardUrl;
            break 2;
          }
        }
      }
      return $url;
    } catch (Exception $e) {
      throw new Exception('error getting reward url');
    }
  }

  public function claimAds() {
    try {
      $videoRewardUrl = $this->getRewardUrl();
      $url = str_replace('@gw_rwd_userid@', $this->user->userId, $videoRewardUrl);
      $this->client->get($url);
    } catch (Exception $e) {
      throw new Exception('error claiming ads');
    }
  }
}
