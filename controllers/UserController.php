<?php
/**
 * RestFul example.
 *
 * @Author     : sunforcherry@gmail.com
 * @CreateTime 2018/3/17 17:02:14
 */

namespace app\controllers;

/***
 * RestFul 默认解析路由
 * 'PUT,PATCH {id}' => 'update',
 * 'DELETE {id}'    => 'delete',
 * 'GET,HEAD {id}'  => 'view',
 * 'POST'           => 'create',
 * 'GET,HEAD'       => 'index',
 * '{id}'           => 'options',
 * ''               => 'options',
 */
class UserController extends BaseController {
//    public function behaviors() {
//        return [];
//    }
    
    /**
     * 新增
     * POST /users
     *
     * @return array
     * @CreateTime 2018/3/19 10:21:54
     * @Author     : sunforcherry@gmail.com
     */
    public function actionCreate() {
        return [
            'token' => (string)\Yii::$app->jwt->issue(['user_id' => 1])
        ];
    }

    /**
     * @SWG\GET(path="/user",
     *     tags={"user"},
     *     summary="用户首页",
     *     description="返回info信息",
     *     @SWG\Parameter(
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description = " success"
     *     )
     * )
     *
     */
    public function actionIndex() {
        return [
            'info' => [
                'header' => \Yii::$app->request->getHeaders()
                                               ->toArray(),
                'get'    => \Yii::$app->request->get()
            ]
        ];
    }
    
    /**
     * 详情
     * GET /users/{id}
     *
     * @CreateTime 2018/3/19 10:20:09
     * @Author     : sunforcherry@gmail.com
     */
    public function actionView() {
        return [
            'view' => [
                'header' => \Yii::$app->request->getHeaders()
                                               ->toArray(),
                'get'    => \Yii::$app->request->get()
            ]
        ];
    }
    
    /**
     * 更新
     * PUT /users/{id}
     *
     * @return array
     * @CreateTime 2018/3/19 10:22:42
     * @Author     : sunforcherry@gmail.com
     */
    public function actionUpdate() {
        //1 / 0;
        
        return [
            'put' => [
                'header' => \Yii::$app->request->getHeaders()
                                               ->toArray(),
                'get'    => \Yii::$app->request->get(),
                'post'   => \Yii::$app->request->post()
            ]
        ];
    }
}