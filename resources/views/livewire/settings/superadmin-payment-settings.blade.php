<div>
    <div
        class="mx-4 p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
        <h3 class="mb-4 text-xl font-semibold dark:text-white">@lang('modules.settings.paymentgatewaySettings')</h3>
        <x-help-text class="mb-6">@lang('modules.settings.paymentHelpSuperadmin')</x-help-text>

        <div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px items-center">
                <!-- Razorpay -->
                <li class="me-2">
                    <span wire:click="activeSetting('razorpay')" @class(["inline-flex items-center gap-x-1 cursor-pointer select-none p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300", 'border-transparent' => ($activePaymentSetting != 'razorpay'), 'active border-skin-base dark:text-skin-base dark:border-skin-base text-skin-base' => ($activePaymentSetting == 'razorpay')])>
                        <svg class="h-4 w-4" width="24" height="24" viewBox="0 0 24 24"><defs><linearGradient id="a" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" stop-color="#0d3e8e"/><stop offset="100%" stop-color="#00c3f3"/></linearGradient></defs><path fill="url(#a)" d="m22.436 0-11.91 7.773-1.174 4.276 6.625-4.297L11.65 24h4.391z"/><path fill="#0D3E8E" d="M14.26 10.098 3.389 17.166 1.564 24h9.008z"/></svg>
                        @lang('modules.billing.razorpay')
                        <span @class(['flex w-3 h-3 me-3 rounded-full','bg-green-500' => $razorpayStatus, 'bg-red-500' => !$razorpayStatus  ])></span>
                    </span>
                </li>

                <!-- Stripe -->
                <li wire:click="activeSetting('stripe')" class="me-2">
                    <span @class(["inline-flex items-center gap-x-1 cursor-pointer select-none p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300", 'border-transparent' => ($activePaymentSetting != 'stripe'), 'active border-skin-base dark:text-skin-base dark:border-skin-base text-skin-base' => ($activePaymentSetting == 'stripe')])>
                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="24" height="24" fill="#6772e5"><path d="M111.328 15.602c0-4.97-2.415-8.9-7.013-8.9s-7.423 3.924-7.423 8.863c0 5.85 3.32 8.8 8.036 8.8 2.318 0 4.06-.528 5.377-1.26V19.22a10.25 10.25 0 0 1-4.764 1.075c-1.9 0-3.556-.67-3.774-2.943h9.497a40 40 0 0 0 .063-1.748zm-9.606-1.835c0-2.186 1.35-3.1 2.56-3.1s2.454.906 2.454 3.1zM89.4 6.712a5.43 5.43 0 0 0-3.801 1.509l-.254-1.208h-4.27v22.64l4.85-1.032v-5.488a5.43 5.43 0 0 0 3.444 1.265c3.472 0 6.64-2.792 6.64-8.957.003-5.66-3.206-8.73-6.614-8.73zM88.23 20.1a2.9 2.9 0 0 1-2.288-.906l-.03-7.2a2.93 2.93 0 0 1 2.315-.96c1.775 0 2.998 2 2.998 4.528.003 2.593-1.198 4.546-2.995 4.546zM79.25.57l-4.87 1.035v3.95l4.87-1.032z" fill-rule="evenodd"/><path d="M74.38 7.035h4.87V24.04h-4.87z"/><path d="m69.164 8.47-.302-1.434h-4.196V24.04h4.848V12.5c1.147-1.5 3.082-1.208 3.698-1.017V7.038c-.646-.232-2.913-.658-4.048 1.43zm-9.73-5.646L54.698 3.83l-.02 15.562c0 2.87 2.158 4.993 5.038 4.993 1.585 0 2.756-.302 3.405-.643v-3.95c-.622.248-3.683 1.138-3.683-1.72v-6.9h3.683V7.035h-3.683zM46.3 11.97c0-.758.63-1.05 1.648-1.05a10.9 10.9 0 0 1 4.83 1.25V7.6a12.8 12.8 0 0 0-4.83-.888c-3.924 0-6.557 2.056-6.557 5.488 0 5.37 7.375 4.498 7.375 6.813 0 .906-.78 1.186-1.863 1.186-1.606 0-3.68-.664-5.307-1.55v4.63a13.5 13.5 0 0 0 5.307 1.117c4.033 0 6.813-1.992 6.813-5.485 0-5.796-7.417-4.76-7.417-6.943zM13.88 9.515c0-1.37 1.14-1.9 2.982-1.9A19.66 19.66 0 0 1 25.6 9.876v-8.27A23.2 23.2 0 0 0 16.862.001C9.762.001 5 3.72 5 9.93c0 9.716 13.342 8.138 13.342 12.326 0 1.638-1.4 2.146-3.37 2.146-2.905 0-6.657-1.202-9.6-2.802v8.378A24.4 24.4 0 0 0 14.973 32C22.27 32 27.3 28.395 27.3 22.077c0-10.486-13.42-8.613-13.42-12.56z" fill-rule="evenodd"/></svg>
                        @lang('modules.billing.stripe')
                        <span @class(['flex w-3 h-3 me-3 rounded-full','bg-green-500' => $stripeStatus, 'bg-red-500' => !$stripeStatus ])></span>
                    </span>
                </li>

                <!-- Flutterwave -->
                <li wire:click="activeSetting('flutterwave')" class="me-2">
                    <span @class(["inline-flex items-center gap-x-1 cursor-pointer select-none p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300", 'border-transparent' => ($activePaymentSetting != 'flutterwave'), 'active border-skin-base dark:text-skin-base dark:border-skin-base text-skin-base' => ($activePaymentSetting == 'flutterwave')])>
                        <svg class="h-4 w-4" width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 176 144.7" xml:space="preserve"><path d="M0 31.6c0-9.4 2.7-17.4 8.5-23.1l10 10C7.4 29.6 17.1 64.1 48.8 95.8s66.2 41.4 77.3 30.3l10 10c-18.8 18.8-61.5 5.4-97.3-30.3C14 80.9 0 52.8 0 31.6" style="fill:#009a46"/><path d="M63.1 144.7c-9.4 0-17.4-2.7-23.1-8.5l10-10c11.1 11.1 45.6 1.4 77.3-30.3s41.4-66.2 30.3-77.3l10-10c18.8 18.8 5.4 61.5-30.3 97.3-24.9 24.8-53.1 38.8-74.2 38.8" style="fill:#ff5805"/><path d="M140.5 91.6C134.4 74.1 122 55.4 105.6 39 69.8 3.2 27.1-10.1 8.3 8.6 7 10 8.2 13.3 10.9 16s6.1 3.9 7.4 2.6c11.1-11.1 45.6-1.4 77.3 30.3 15 15 26.2 31.8 31.6 47.3 4.7 13.6 4.3 24.6-1.2 30.1-1.3 1.3-.2 4.6 2.6 7.4s6.1 3.9 7.4 2.6c9.6-9.7 11.2-25.6 4.5-44.7" style="fill:#f5afcb"/><path d="M167.5 8.6C157.9-1 142-2.6 122.9 4c-17.5 6.1-36.2 18.5-52.6 34.9-35.8 35.8-49.1 78.5-30.3 97.3 1.3 1.3 4.7.2 7.4-2.6s3.9-6.1 2.6-7.4c-11.1-11.1-1.4-45.6 30.3-77.3 15-15 31.8-26.2 47.2-31.6 13.6-4.7 24.6-4.3 30.1 1.2 1.3 1.3 4.6.2 7.4-2.6s3.9-5.9 2.5-7.3" style="fill:#ff9b00"/></svg>
                        @lang('modules.billing.flutterwave')
                        <span @class(['flex w-3 h-3 me-3 rounded-full','bg-green-500' => $flutterwaveStatus, 'bg-red-500' => !$flutterwaveStatus ])></span>
                    </span>
                </li>

                <!-- Offline Payment -->
                <li wire:click="activeSetting('offline_payment_method')" class="me-2">
                    <span @class(["inline-flex items-center gap-x-2 cursor-pointer select-none p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300", 'border-transparent' => ($activePaymentSetting != 'offline_payment_method'), 'active border-skin-base dark:text-skin-base dark:border-skin-base text-skin-base' => ($activePaymentSetting == 'offline_payment_method')])>
                        <svg class="h-5 w-5 text-current" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g stroke-width="0"/><g stroke-linecap="round" stroke-linejoin="round"/><path d="M12 16h1c.667 0 2-.4 2-2s-1.333-2-2-2h-2c-.667 0-2-.4-2-2s1.333-2 2-2h1m0 8H9m3 0v2m3-10h-3m0 0V6m9 6a9 9 0 1 1-18 0 9 9 0 0 1 18 0" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        @lang('modules.billing.offlinePaymentMethod')
                    </span>
                </li>
            </ul>
        </div>

        <!-- Razorpay Form -->
        @if($activePaymentSetting == 'razorpay')
        <form wire:submit="submitFormRazorpay">
            <div class="grid gap-6">

                <div class="my-3">
                    <x-label for="razorpayStatus">
                        <div class="flex items-center cursor-pointer">
                            <x-checkbox name="razorpayStatus" id="razorpayStatus" wire:model.live='razorpayStatus'/>

                            <div class="ms-2">
                                @lang('modules.settings.enableRazorpay')
                            </div>
                        </div>
                    </x-label>
                </div>

                @if ($razorpayStatus)
                    <div>
                        <x-label for="selectRazorpayEnvironment" :value="__('modules.settings.selectEnvironment')"/>
                        <x-select id="selectRazorpayEnvironment" class="mt-1 block w-full" wire:model.live="selectRazorpayEnvironment">
                            <option value="test">@lang('app.test')</option>
                            <option value="live">@lang('app.live')</option>
                        </x-select>
                        <x-input-error for="selectRazorpayEnvironment" class="mt-2"/>
                    </div>

                    @if ($selectRazorpayEnvironment == 'live')
                        <div>
                            <x-label for="razorpayKey" :value="__('modules.settings.razorpayKey')"/>
                            <x-input id="razorpayKey" class="block mt-1 w-full" type="text" wire:model='razorpayKey'/>
                            <x-input-error for="razorpayKey" class="mt-2"/>
                        </div>

                        <div>
                            <x-label for="razorpaySecret" :value="__('modules.settings.razorpaySecret')"/>
                            <x-input-password id="razorpaySecret" class="block mt-1 w-full" type="text" wire:model='razorpaySecret'/>
                            <x-input-error for="razorpaySecret" class="mt-2"/>
                        </div>

                        <div>
                            <x-label for="razorpayWebhookKey" :value="__('modules.settings.razorpayWebhookKey')"/>
                            <x-input-password id="razorpayWebhookKey" class="block mt-1 w-full" type="text" wire:model='razorpayWebhookKey'/>
                            <x-input-error for="razorpayWebhookKey" class="mt-2"/>
                        </div>
                    @else
                        <div>
                            <x-label for="testRazorpayKey" :value="__('modules.settings.testRazorpayKey')"/>
                            <x-input id="testRazorpayKey" class="block mt-1 w-full" type="text" wire:model='testRazorpayKey'/>
                            <x-input-error for="testRazorpayKey" class="mt-2"/>
                        </div>

                        <div>
                            <x-label for="testRazorpaySecret" :value="__('modules.settings.testRazorpaySecret')"/>
                            <x-input-password id="testRazorpaySecret" class="block mt-1 w-full" type="text" wire:model='testRazorpaySecret'/>
                            <x-input-error for="testRazorpaySecret" class="mt-2"/>
                        </div>

                        <div>
                            <x-label for="testRazorpayWebhookKey" :value="__('modules.settings.testRazorpayWebhookKey')"/>
                            <x-input-password id="testRazorpayWebhookKey" class="block mt-1 w-full" type="text" wire:model='testRazorpayWebhookKey'/>
                            <x-input-error for="testRazorpayWebhookKey" class="mt-2"/>
                        </div>

                    @endif
                    <div class="mt-4">
                        <x-label :value="__('modules.settings.webhookUrl')" class="mb-1"/>
                        <div class="flex items-center">
                            <!-- Webhook URL Input -->
                            <span class="purchase-code transition duration-300 font-medium dark:text-white bg-gray-100 px-1 py-1 rounded cursor-pointer group relative"
                         id="webhook-url-razorpay">
                            {{$webhookUrl}}
                        </span>
                            <button id="copy-button" type="button" onclick="copyWebhookUrl('webhook-url-razorpay')" class="ml-2 px-3 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-700">
                                @lang('modules.settings.copyWebhookUrl')
                            </button>
                        </div>
                    </div>

                @endif

                <div>
                    <x-button>@lang('app.save')</x-button>
                </div>
            </div>
        </form>
        @endif

        <!-- Stripe Form -->
        @if($activePaymentSetting == 'stripe')
        <form wire:submit="submitFormStripe">
            <div class="grid gap-6">
                <div class="my-3">
                    <x-label for="stripeStatus">
                        <div class="flex items-center cursor-pointer">
                            <x-checkbox name="stripeStatus" id="stripeStatus" wire:model.live='stripeStatus'/>

                            <div class="ms-2">
                                @lang('modules.settings.enableStripe')
                            </div>
                        </div>
                    </x-label>
                </div>

                @if ($stripeStatus)

                    <div>
                        <x-label for="selectStripeEnvironment" :value="__('modules.settings.selectEnvironment')"/>
                        <x-select id="selectStripeEnvironment" class="mt-1 block w-full" wire:model.live="selectStripeEnvironment">
                            <option value="test">@lang('app.test')</option>
                            <option value="live">@lang('app.live')</option>
                        </x-select>
                        <x-input-error for="selectStripeEnvironment" class="mt-2"/>
                    </div>

                    @if ($selectStripeEnvironment == 'live')
                        <div class="mb-2">
                            <p class="text-sm text-gray-600">
                                <a href="https://dashboard.stripe.com/apikeys" target="_blank" class="text-blue-600 hover:underline flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                    @lang('modules.settings.getStripeCredentials')
                                </a>
                            </p>
                        </div>
                        <div>
                            <x-label for="stripeKey" :value="__('modules.settings.stripeKey')"/>
                            <x-input id="stripeKey" class="block mt-1 w-full" type="text" wire:model='stripeKey'/>
                            <x-input-error for="stripeKey" class="mt-2"/>
                        </div>

                        <div>
                            <x-label for="stripeSecret" :value="__('modules.settings.stripeSecret')"/>
                            <x-input-password id="stripeSecret" class="block mt-1 w-full" type="text" wire:model='stripeSecret'/>
                            <x-input-error for="stripeSecret" class="mt-2"/>
                        </div>

                        <div>
                            <x-label for="stripeWebhookKey" :value="__('modules.settings.stripeWebhookKey')"/>
                            <x-input-password id="stripeWebhookKey" class="block mt-1 w-full" type="text" wire:model='stripeWebhookKey'/>
                            <x-input-error for="stripeWebhookKey" class="mt-2"/>
                        </div>
                    @else
                        <div class="mb-2">
                            <p class="text-sm text-gray-600">
                                <a href="https://dashboard.stripe.com/test/apikeys" target="_blank" class="text-blue-600 hover:underline flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                    @lang('modules.settings.getStripeTestCredentials')
                                </a>
                            </p>
                        </div>
                        <div>
                            <x-label for="testStripeKey" :value="__('modules.settings.testStripeKey')"/>
                            <x-input id="testStripeKey" class="block mt-1 w-full" type="text" wire:model='testStripeKey'/>
                            <x-input-error for="testStripeKey" class="mt-2"/>
                        </div>

                        <div>
                            <x-label for="testStripeSecret" :value="__('modules.settings.testStripeSecret')"/>
                            <x-input-password id="testStripeSecret" class="block mt-1 w-full" type="text" wire:model='testStripeSecret'/>
                            <x-input-error for="testStripeSecret" class="mt-2"/>
                        </div>

                        <div>
                            <x-label for="testStripeWebhookKey" :value="__('modules.settings.testStripeWebhookKey')"/>
                            <x-input-password id="testStripeWebhookKey" class="block mt-1 w-full" type="text" wire:model='testStripeWebhookKey'/>
                            <x-input-error for="testStripeWebhookKey" class="mt-2"/>
                        </div>
                    @endif
                    <div class="mt-4">
                        <x-label :value="__('modules.settings.webhookUrl')" class="mb-1"/>
                        <div class="flex items-center">
                            <!-- Webhook URL Input -->
                            <span class="purchase-code transition duration-300 font-medium dark:text-white bg-gray-100 px-1 py-1 rounded cursor-pointer group relative"
                         id="webhook-url-stripe">
                            {{$webhookUrl}}
                        </span>
                            <button id="copy-button" type="button" onclick="copyWebhookUrl('webhook-url-stripe')" class="ml-2 px-3 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-700">
                                @lang('modules.settings.copyWebhookUrl')
                            </button>
                        </div>
                    </div>
                @endif

                <div>
                    <x-button>@lang('app.save')</x-button>
                </div>
            </div>
        </form>
        @endif

        <!-- Flutterwave Form -->
        @if($activePaymentSetting == 'flutterwave')
        <form wire:submit="submitFormFlutterwave">
            <div class="grid gap-6">

                <div class="my-3">
                    <x-label for="flutterwaveStatus">
                        <div class="flex items-center cursor-pointer">
                            <x-checkbox name="flutterwaveStatus" id="flutterwaveStatus" wire:model.live='flutterwaveStatus'/>

                            <div class="ms-2">
                                @lang('modules.settings.enableFlutterwave')
                            </div>
                        </div>
                    </x-label>
                </div>

                @if ($flutterwaveStatus)
                    <div>
                        <x-label for="selectFlutterwaveEnvironment" :value="__('modules.settings.selectEnvironment')" required/>
                        <x-select id="selectFlutterwaveEnvironment" class="mt-1 block w-full" wire:model.live="selectFlutterwaveEnvironment">
                            <option value="test">@lang('app.test')</option>
                            <option value="live">@lang('app.live')</option>
                        </x-select>
                        <x-input-error for="selectFlutterwaveEnvironment" class="mt-2"/>
                    </div>

                    @if ($selectFlutterwaveEnvironment == 'live')
                        <div class="grid grid-cols-2 gap-x-4">
                            <div>
                                <x-label for="flutterwaveKey" :value="__('modules.settings.flutterwaveKey')" required/>
                                <x-input id="flutterwaveKey" class="block mt-1 w-full" type="text" wire:model='flutterwaveKey'/>
                                <x-input-error for="flutterwaveKey" class="mt-2"/>
                            </div>

                            <div>
                                <x-label for="flutterwaveSecret" :value="__('modules.settings.flutterwaveSecret')" required/>
                                <x-input-password id="flutterwaveSecret" class="block mt-1 w-full" type="text" wire:model='flutterwaveSecret'/>
                                <x-input-error for="flutterwaveSecret" class="mt-2"/>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-x-4">
                            <div>
                                <x-label for="flutterwaveHash" :value="__('modules.settings.flutterwaveEncryptionKey')" required/>
                                <x-input-password id="flutterwaveHash" class="block mt-1 w-full" type="text" wire:model='flutterwaveHash'/>
                                <x-input-error for="flutterwaveHash" class="mt-2"/>
                            </div>

                            <div>
                                <x-label for="flutterwaveWebhookKey" :value="__('modules.settings.flutterwaveWebhookHash')"/>
                                <x-input id="flutterwaveWebhookKey" class="block mt-1 w-full" type="text" wire:model='flutterwaveWebhookKey'/>
                                <x-input-error for="flutterwaveWebhookKey" class="mt-2"/>
                            </div>
                        </div>
                    @else
                        <div class="grid grid-cols-2 gap-x-4">
                            <div>
                                <x-label for="testFlutterwaveKey" :value="__('modules.settings.testFlutterwaveKey')" required/>
                                <x-input id="testFlutterwaveKey" class="block mt-1 w-full" type="text" wire:model='testFlutterwaveKey'/>
                                <x-input-error for="testFlutterwaveKey" class="mt-2"/>
                            </div>

                            <div>
                                <x-label for="testFlutterwaveSecret" :value="__('modules.settings.testFlutterwaveSecret')" required/>
                                <x-input-password id="testFlutterwaveSecret" class="block mt-1 w-full" type="text" wire:model='testFlutterwaveSecret'/>
                                <x-input-error for="testFlutterwaveSecret" class="mt-2"/>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-x-4">
                            <div>
                                <x-label for="testFlutterwaveHash" :value="__('modules.settings.testFlutterwaveEncryptionKey')" required/>
                                <x-input-password id="testFlutterwaveHash" class="block mt-1 w-full" type="text" wire:model='testFlutterwaveHash'/>
                                <x-input-error for="testFlutterwaveHash" class="mt-2"/>
                            </div>

                            <div>
                                <x-label for="testFlutterwaveWebhookKey" :value="__('modules.settings.testFlutterwaveWebhookHash')"/>
                                <x-input id="testFlutterwaveWebhookKey" class="block mt-1 w-full" type="text" wire:model='testFlutterwaveWebhookKey'/>
                                <x-input-error for="testFlutterwaveWebhookKey" class="mt-2"/>
                            </div>
                        </div>

                    @endif
                    <div class="mt-4">
                        <x-label :value="__('modules.settings.webhookUrl')" class="mb-1"/>
                        <div class="flex items-center">
                            <!-- Webhook URL Input -->
                            <span class="purchase-code transition duration-300 font-medium dark:text-white bg-gray-100 px-1 py-1 rounded cursor-pointer group relative"
                         id="webhook-url-flutterwave">
                            {{$webhookUrl}}
                        </span>
                            <button id="copy-button" type="button" onclick="copyWebhookUrl('webhook-url-flutterwave')" class="ml-2 px-3 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-700">
                                @lang('modules.settings.copyWebhookUrl')
                            </button>
                        </div>
                    </div>

                @endif

                <div>
                    <x-button>@lang('app.save')</x-button>
                </div>
            </div>
        </form>
        @endif

        @if($activePaymentSetting == 'offline_payment_method')
            @livewire('offline-payment.offline-payment-method-tab')
        @endif

    </div>

    <script>
        function copyWebhookUrl(id) {
            let webhookUrl=document.getElementById(id).textContent.trim();
            let copyButton = document.getElementById("copy-button");

            // Create a temporary textarea element
            let tempTextArea = document.createElement("textarea");
            tempTextArea.value = webhookUrl;
            document.body.appendChild(tempTextArea);

            // Select and copy the text
            tempTextArea.select();
            tempTextArea.setSelectionRange(0, 99999); // For mobile devices
            document.execCommand("copy");

            // Remove the temporary textarea
            document.body.removeChild(tempTextArea);

            // Change button text to "Copied!"
            copyButton.innerText = "@lang('modules.settings.copied')";

            // Revert text back to original after 2 seconds
            setTimeout(() => {
                copyButton.innerText = "Copy";
            }, 2000);
        }
    </script>
</div>
