<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/3/30
 * Time: 15:03
 */

namespace App\Console\Commands;

use App\Models\DataModels\UserModel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class Login extends Command
{
    protected $signature = 'login';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'user password';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //$this->getTable();

        $this->progressBar();
    }


    public function getTable()
    {
        //输出表格，table('表头'，' Eloquent ORM')
        $data = (new UserModel())->select('id','name','email')->where('id','<',5)->get()->toArray();
        $headers = ['ID','Name','Email'];
        $this->table($headers,$data);
    }

    public function outPut()
    {
        $this->error('admin');//红色输出
        $this->info('root');//绿色输出
        $this->line('123456');//无色输出
        //提示输入的
        $name = $this->ask('what is your name');

        //确认输入，默认是no,返回false，
        if ($this->confirm('do you with continue name')) {
            $this->info($name);
        }

        $password = $this->secret('what is your is password');
        if ($this->confirm('do you with continue name')) {
            $this->info($password);
        }

        //默认补全
        $username = $this->anticipate('what is your name ?',['admin','root','liyi']);
        if ($this->confirm('do you with continue name')) {
            $this->info($username);
        }

        //多重选择，指定默认输出
        $defaultIndex = 0;
        $this->choice('What is your name?', ['Taylor', 'Dayle'], $defaultIndex);
    }


    /**
     * 进度条
     */
    public function progressBar()
    {
        $data = (new UserModel())->select('id','name','email')->where('id','<',20)->get()->toArray();
        $bar = $this->output->createProgressBar(count($data));

        $bar->start();

        foreach ($data as $item) {
            //$this->performTask($item);
           var_dump($item);
            $bar->advance();
        }

        $bar->finish();
    }
}
