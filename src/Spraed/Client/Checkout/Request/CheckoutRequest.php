<?php

namespace Spraed\Client\Checkout\Request;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author derstoffel <derstoffel@posteo.de>
 */
class CheckoutRequest
{
    const ORDER_TYPE_DIRECT_SALE = 'DIRECT_SALE';
    const ORDER_TYPE_ORDER = 'ORDER';

    /**
     * Type of Order
     * One of the constants values ORDER_TYPE
     *
     * @var string
     * @Assert\NotBlank()
     * @Assert\Choice({"DIRECT_SALE", "ORDER"})
     */
    private $type;

    /**
     * Amount of the order including shipping costs
     *
     * @var double
     * @Assert\NotBlank()
     * @Assert\GreaterThanOrEqual(0.01)
     * @Assert\LessThanOrEqual(50000)
     */
    private $totalAmount;

    /**
     * Currency of the amount
     *
     * @var string
     * @Assert\NotBlank()
     * @Assert\EqualTo("EUR")
     */
    private $currency  = 'EUR';

    /**
     * Merchant internal reference number for order
     *
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min = 1,
     *     max = 20,
     *     minMessage = "Your merchantOrderReferenceNumber must be at least {{ limit }} characters long",
     *     maxMessage = "Your merchantOrderReferenceNumber cannot be longer than {{ limit }} characters"
     * )
     */
    private $merchantOrderReferenceNumber;

    /**
     * Url which is called after successful interaction
     *
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min = 1,
     *     max = 2000,
     *     minMessage = "Your redirectUrlAfterSuccess must be at least {{ limit }} characters long",
     *     maxMessage = "Your redirectUrlAfterSuccess cannot be longer than {{ limit }} characters"
     * )
     */
    private $redirectUrlAfterSuccess;

    /**
     * Url which is called after non-successful interaction
     *
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min = 1,
     *     max = 2000,
     *     minMessage = "Your redirectUrlAfterRejection must be at least {{ limit }} characters long",
     *     maxMessage = "Your redirectUrlAfterRejection cannot be longer than {{ limit }} characters"
     * )
     */
    private $redirectUrlAfterRejection;

    /**
     * @param string $type
     * @param float $totalAmount
     * @param string $merchantOrderReferenceNumber
     * @param string $redirectUrlAfterSuccess
     * @param string $redirectUrlAfterRejection
     */
    public function __construct($type, $totalAmount, $merchantOrderReferenceNumber, $redirectUrlAfterSuccess, $redirectUrlAfterRejection)
    {
        $this->type = $type;
        $this->totalAmount = $totalAmount;
        $this->merchantOrderReferenceNumber = $merchantOrderReferenceNumber;
        $this->redirectUrlAfterSuccess = $redirectUrlAfterSuccess;
        $this->redirectUrlAfterRejection = $redirectUrlAfterRejection;
    }
}
