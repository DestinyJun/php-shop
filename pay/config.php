<?php
$config = array (	
		//应用ID,您的APPID。
		'app_id' => "2016101700708607",

		//商户私钥
		'merchant_private_key' => "MIIEowIBAAKCAQEAl2HlfCy1doNvPrf0hwJMTtA2poldTwPJJDsi8x73XrtE810LZU4Emi3iCNb2BQFNIiFi8aJPMPhz1u3Yy4fdC0ESugdSm2/Wsag+oT67+vRO2NEOJhLpTqjlgm2eYyePiofdWNhDEota/zYEd+qEitj/FK5/HpF5U3gTY+T/KY8SlCzpKNlKBJ1eiX5CkK4uQrWeeXyfq4BV0njobna/Q9zY46XSKzktESzJCnRxRkEpmjgI9CiQyUre2RoBs1S/oXtRLVCRzSXuLhR9G/berrIcayQLNUKbpjNpRbsq5qMLxwZ2NnXN0LGC8PCK7HpRjeBTn1Oe/68UaRRh7pzHmQIDAQABAoIBAF7KWRVJNZNxN55xN7e2U6viKuZbC0dn2nJKaVcNI954qvMsZu9XTABzDJ92YvS9XNwrRbaCaM4ENRz3MBI6D8p1Q9GitjJIdIooDJeRHcpFYn3XYeGrY9XyYkwqccwqwHIBIzP3rwAUrLUz0NZ5zebXe9oqbcTpWKxQeuvJP5F4YwGAuRj0spOEu63NEPbS4bLOeEC9MnOBK1BYApZqJ6CiQq/TMa2VUHQxPfWl8HsdaISXoMmdbuHMqBIqrFNlJA2RhACgRc4TrSBPJI8rM92Fp5RHphMgQHYS8kQ7dPL0aVMO6hz2+LRHc6Wz2GDC2F6lDydmfvnce5TgDsLo09UCgYEA03aQtgpllH4RoHj5dGvo7kppn6vb50lzjgmoMznbvwRY4XLJqGS/r4f+2twYNc/vISnLP4hfvhKQ04BMElAZ7wLKD0wbmr0A3YR1TDZAInlZ/HjDUxEmRIaf25QE7USJl5eqFapSm5MS/fq3Xi54urs5kqoQZeSdt4ygsvVxHxsCgYEAt0P2+aw2NxF1MjL5bmSgXa9LqHhw/wu4iJ5kmvCQ9QOo84dn51IDJm19V7iLfhyPAhUVT7X3+AeYqgS6AcpDrtXRBOGJKqbCNk+G6zBcyqOj0CjhU0g1pTSti9ceSBLRCDD7NwhPTYtHS9sPD0gDnaNjNpWFDzhA+6KrRM3qu1sCgYBkXTTHwd1+getZz7EOCZ1vY9AH4aioeJsowfqb/Y0Hd0e8ESAXFWJJLHHQbH/tInirs8tspwxSCTvFtnHkizIT164RXp0Hb0c23ARUHLeJ5TDJfIOwLEaOZZr/u5wvBMWNNoWabNFyV3a/JrzbLZFNh0kHDEJmKgCVOmCXL5j2GwKBgQC2LX3J3ANY4qXZ7Qo/TxCLkMJpCrFpF8GtLadczl+K8MR2sdf7/27aOGUtWmpwRvtyWnsA7ic+DG8aM/Cj7ukxV6OccobkOzk8u/mmukDDv8AMIVc8br/FJoSOSp3zj6Dzv506q6wJrbaGFZD24+OURONPU3seEhGnE6Gll/0LmQKBgG4+IpGF+jgDjI5fANxZW4LFeHlQQlIUdduTR1rlbhd+e21iYJqAoeNij3uuNhmfwiyoxnrvHr44VzTU07exXYvAloEwrx5HBDTjsV3B1djATdAq+DMdvEvrqAY+nbZ1NlaMnfKBQDwMxOz2MHKrleThW/s693mg/T1mVDumAHNG",
		
		//异步通知地址
		'notify_url' => "http://www.wshop.com/pay/notify_url.html",
		
		//同步跳转
		'return_url' => "http://www.wshop.com/Order/returnUrl.html",

		//编码格式
		'charset' => "UTF-8",

		//签名方式
		'sign_type'=>"RSA2",

		//支付宝网关
		'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
		'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAr1kqoVN1xJ1IHaybfL7o5OuezXY0wVPbmNUqygvLfVLeOiArBpGS5UQcRmkWljTTgZTrUOfrTJ6tlzUJiypry7jN0hNMqbKY0FeWNPbQ0+DD4LicElBsTFPNqXjcY/nhe0J301mjm/bdtMrHZHxVoH0HryU3xQB30gPhDjxwrwOnrJVwff2Srm5xN6PNVrBDWAbk56X/b6tbMLs+3OgNOCCyCJarPnuf4ZAQmOr4qP7Fl3r+vTLSGRTiWY46ZnLB42/fL1CeYBZQUT5mAad+VMEPYZXHEZNb5b4WTgAfMMfMiixvc/F4KqnjspV8VNXY2i8iYQK/pQtuy4zI7NoRYwIDAQAB",
);
