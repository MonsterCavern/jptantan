<?php

/**
 * @OA\Schema(
 *      schema="Query",
 *      required={""},
 *      @OA\Property(
 *          property="filter",
 *          description="where",
 *          type="object",
 *         example={"type":"temperature"}
 *      ),
 *      @OA\Property(
 *          property="sort",
 *          description="orderBy",
 *          type="string",
 *          example="-id"
 *      ),
 *      @OA\Property(
 *          property="limit",
 *          description="orderBy",
 *          type="integer",
 *          example="20"
 *      ),
 *      @OA\Property(
 *          property="page",
 *          description="orderBy",
 *          type="integer",
 *          example="1"
 *      ),
 * )
 */

/**
 *   @OA\Parameter(
 *          parameter="filter",
 *          name="filter",
 *          in="query",
 *          explode="true",
 *          style="deepObject",
 *          @OA\Schema(
 *              type="object",
 *              @OA\Property(
 *                  property="type",
 *                  type="string",
 *                  example="temp"
 *              ),
 *          ),
 *   )
 * /


 * /**
 *   @OA\Parameter(
 *          name="sort",
 *          description="ex: id,-created_at",
 *          in="query",
 *          @OA\Schema(
 *              type="string",
 *              example="-id"
 *          ),
 *   )
 * /

 * /**
 *   @OA\Parameter(
 *          name="limit",
 *          in="query",
 *          @OA\Schema(
 *              type="integer",
 *              example=20
 *          ),
 *   )
 * /

 * /**
 *   @OA\Parameter(
 *          name="page",
 *          in="query",
 *          @OA\Schema(
 *              type="integer",
 *              example=1
 *          ),
 *   )
 * /
