<?php

namespace App\Http\Controllers\Ajax;

use Card;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use App\Http\Requests\{CardSend, CardCount, SendOrder};
use App\Order;

/**
 * Class OrderAjaxController
 * @package App\Http\Controllers\Ajax
 */
class OrderAjaxController
{
    /**
     * @param CardSend $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function putToCard(CardSend $request)
    {
        try {
            $id = $request->post('id');

            if (Card::putToCard($id, 1)) {
                return response()->json([
                    'success' => 1,
                    'total_amount' => Card::getTotalAmount()
                ]);
            }

            return response()->json([
                'success' => 0
            ]);

        } catch (\Exception $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
    }

    /**
     * @param CardCount $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function setCountInCard(CardCount $request)
    {
        try {
            $id = $request->post('id');
            $count = $request->post('count');

            if (Card::setCountInCard($id, $count)) {
                $modelItems = Card::getModelItems();

                return response()->json([
                    'success' => 1,
                    'total_amount' => Card::calculateTotalAmount($modelItems),
                    'item_price' => $modelItems[$id]->price
                ]);
            }

            return response()->json([
                'success' => 0
            ]);

        } catch (\Exception $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
    }

    /**
     * @param CardSend $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeFromCard(CardSend $request)
    {
        try {
            $id = $request->post('id');

            if (Card::removeFromCard($id)) {
                return response()->json([
                    'success' => 1,
                    'total_amount' => Card::getTotalAmount()
                ]);
            }

            return response()->json([
                'success' => 0
            ]);

        } catch (\Exception $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
    }

    /**
     * @param SendOrder $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendOrder(SendOrder $request)
    {
        try {
            $order = Order::create([
                'user_name' => $request->post('user_name'),
                'user_email' => $request->post('user_email'),
                'user_comment' => $request->post('user_comment'),
            ]);

            $productCounts = array_map(function ($item) {
                return [
                    'count' => $item
                ];
            }, $request->post('card_counts'));

            $order->products()->sync($productCounts);

            Card::clearCard();

            return response()->json([
                'success' => 1,
                'total_amount' => 0
            ]);

        } catch (\Exception $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
    }
}