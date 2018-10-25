<?php

/**
 * @OA\Schema(
 *      schema="SensorData",
 *      required={""},
 *      @OA\Property(
 *          property="sensor_id",
 *          description="sensor id",
 *          type="string",
 *          example="16:FF:4F:3A:CF:32"
 *      ),
 *      @OA\Property(
 *          property="type",
 *          description="type",
 *          type="string",
 *          example="gps"
 *      ),
 *      @OA\Property(
 *          property="timestamp",
 *          description="timestamp",
 *          type="integer",
 *          format="int32",
 *          example="1014796100"
 *      ),
 *      @OA\Property(
 *          property="data",
 *          description="data",
 *          type="object",
 *          example={ "lat": 23.1231456, "lng": 124.556 }
 *      )
 * )
 */
