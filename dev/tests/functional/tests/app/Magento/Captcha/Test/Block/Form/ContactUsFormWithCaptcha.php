<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Captcha\Test\Block\Form;

use Magento\Mtf\Block\Form;
use Magento\Mtf\Client\Locator;
use Magento\Mtf\Fixture\FixtureInterface;
use Magento\Mtf\Client\Element\SimpleElement;

/**
 * Form for "Contact Us" page with captcha.
 */
class ContactUsFormWithCaptcha extends Form
{
    /**
     * Submit form button.
     *
     * @var string
     */
    private $submit = '.action.submit';

    /**
     * Captcha image selector.
     *
     * @var string
     */
    private $captchaImage = '.captcha-img';

    /**
     * Captcha reload button selector.
     *
     * @var string
     */
    private $captchaReload = '.captcha-reload';

    /**
     * Get captcha element visibility.
     *
     * @return bool
     */
    public function isVisibleCaptcha()
    {
        return $this->_rootElement->find($this->captchaImage, Locator::SELECTOR_CSS)->isVisible();
    }

    /**
     * Get captcha reload button element visibility.
     *
     * @return bool
     */
    public function isVisibleCaptchaReloadButton()
    {
        return $this->_rootElement->find($this->captchaReload, Locator::SELECTOR_CSS)->isVisible();
    }

    /**
     * Click captcha reload button element.
     *
     * @return void
     */
    public function reloadCaptcha()
    {
        $this->_rootElement->find($this->captchaReload, Locator::SELECTOR_CSS)->click();
    }

    /**
     * Click submit button.
     *
     * @return void
     */
    public function sendComment()
    {
        $this->_rootElement->find($this->submit, Locator::SELECTOR_CSS)->click();
    }

    /**
     * Fill the contact us form.
     *
     * @param FixtureInterface $fixture
     * @param SimpleElement|null $element
     * @return $this
     */
    public function fill(FixtureInterface $fixture, SimpleElement $element = null)
    {
        $data = $fixture->getData();
        $data['firstname'] = $data['customer']['firstname'];
        $data['email'] = $data['customer']['email'];
        unset($data['customer']);
        $this->_fill($this->dataMapping($data), $element);

        return $this;
    }
}
