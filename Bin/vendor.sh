#!/bin/bash

cd ..;

composer require silex/silex
RESULT=$?
if [ $RESULT -eq 0 ]; then
    composer require knplabs/console-service-provider
	RESULT=$?
	if [ $RESULT -eq 0 ]; then
		composer require symfony/var-dumper
		RESULT=$?
		if [ $RESULT -eq 0 ]; then
			composer require monolog/monolog
			RESULT=$?
			if [ $RESULT -eq 0 ]; then
				composer require symfony/translation
				RESULT=$?
				if [ $RESULT -eq 0 ]; then
					composer require symfony/config
					RESULT=$?
					if [ $RESULT -eq 0 ]; then
						composer require symfony/yaml
						RESULT=$?
						if [ $RESULT -eq 0 ]; then
							composer require php-http/guzzle6-adapter
							RESULT=$?
							if [ $RESULT -eq 0 ]; then
								composer require symfony/stopwatch
								RESULT=$?
								if [ $RESULT -eq 0 ]; then
									composer require predis/service-provider
									RESULT=$?
									if [ $RESULT -eq 0 ]; then
										composer require illuminate/database
										RESULT=$?
										if [ $RESULT -eq 0 ]; then
											composer require symfony/psr-http-message-bridge
											RESULT=$?
											if [ $RESULT -eq 0 ]; then
												composer require zendframework/zend-diactoros
												RESULT=$?
												if [ $RESULT -eq 0 ]; then
													composer require rmccue/requests
													RESULT=$?
													if [ $RESULT -eq 0 ]; then
														composer require twig/twig
														RESULT=$?
														if [ $RESULT -eq 0 ]; then
															composer require symfony/twig-bridge
															RESULT=$?
															if [ $RESULT -eq 0 ]; then
																composer require twig/extensions
																RESULT=$?
																if [ $RESULT -eq 0 ]; then
																	composer require nochso/html-compress-twig
																	RESULT=$?
																	if [ $RESULT -eq 0 ]; then
																		composer require erusev/parsedown
																		RESULT=$?
																		if [ $RESULT -eq 0 ]; then
																			composer require erusev/parsedown-extra
																			RESULT=$?
																			if [ $RESULT -eq 0 ]; then
																				composer require symfony/filesystem
																				RESULT=$?
																				if [ $RESULT -eq 0 ]; then
																					composer require symfony/asset
																					RESULT=$?
																					if [ $RESULT -eq 0 ]; then
																						composer require symfony/finder
																						RESULT=$?
																						if [ $RESULT -eq 0 ]; then
																							composer require kriswallsmith/assetic
																							RESULT=$?
																							if [ $RESULT -eq 0 ]; then
																								composer require symfony/validator
																								RESULT=$?
																								if [ $RESULT -eq 0 ]; then
																									composer require bandwidth-throttle/token-bucket
																									RESULT=$?
																									if [ $RESULT -eq 0 ]; then
																									
																										composer require illuminate/pagination illuminate/events
																										RESULT=$?
																										if [ $RESULT -eq 0 ]; then
																											composer require ramsey/uuid
																											RESULT=$?
																											if [ $RESULT -eq 0 ]; then
																												composer require moust/silex-cache
																												RESULT=$?
																												if [ $RESULT -eq 0 ]; then
																													composer require layershifter/tld-database
																													RESULT=$?
																													if [ $RESULT -eq 0 ]; then
																														sed -i '$s/}/,\n"autoload":{\n"psr-4":{\n"Controllers\\\\\": "Src\/Controllers",\n"Providers\\\\": "Src\/Providers",\n"Helper\\\\": "Src\/Helpers",\n"Component\\\\": "Src\/Component",\n"Models\\\\": "Src\/Models",\n"Console\\\\": "Src\/Console"}\n}\n}/' composer.json
																														echo 'Composer installation completed'
																														composer update && composer dump-autoload --optimize
																														echo 'Composer update is finished'
																														
																													else
																														echo failed layershifter/tld-database
																													fi
																												else
																													echo failed moust/silex-cache
																												fi

																											else
																												echo failed ramsey/uuid
																											fi
																										else
																											echo failed illuminate/pagination illuminate/events
																										fi
																									else
																										echo failed bandwidth-throttle/token-bucket
																									fi
																								else
																									echo failed symfony/validator
																								fi
																							else
																								echo failed kriswallsmith/assetic
																							fi
																						else
																							echo failed symfony/finder
																						fi
																					else
																						echo failed symfony/asset
																					fi
																				else
																					echo failed symfony/filesystem
																				fi
																			else
																				echo failed erusev/parsedown-extra
																			fi
																		else
																			echo failed erusev/parsedown
																		fi
																	else
																		echo failed nochso/html-compress-twig
																	fi
																else
																	echo failed twig/extensions
																fi
															else
																echo failed symfony/twig-bridge
															fi
														else
															echo failed twig/twig
														fi
													else
														echo failed rmccue/requests
													fi
												else
													echo failed zendframework/zend-diactoros
												fi
											else
												echo failed symfony/psr-http-message-bridge
											fi
										else
											echo failed illuminate/database
										fi
									else
										echo failed predis/service-provider
									fi
								else
									echo failed symfony/stopwatch
								fi
							else
								echo failed php-http/guzzle6-adapter
							fi
						else
							echo failed symfony/yaml
						fi
					else
						echo failed symfony/config
					fi
				else 
					echo failed symfony/translation
				fi
			else 
				echo failed monolog
			fi
		else 
			echo failed symfony/var-dumper
		fi
	else 
		echo failed knplabs/console-service-provider
	fi
else
  echo failed silex
fi
