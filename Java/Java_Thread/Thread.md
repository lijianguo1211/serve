### java线程了解

java 的多线程主要是通过`Thread | Runnable`,继承`Thread`类和实现`Runnable`接口实现

- `Thread` 类提供几个方法

1.`getName`  获得线程名称

2.`getPriority`  获得线程优先级

3.`jsAlive`  判定线程是否在运行

4.`join`  等待一个线程结束

6.`run` 线程的入口点

7.`sleep`  在一个时间内挂起线程

8.`start`  通过调用运行方法来启动线程


- 主线程 `main thread`

1) 产生其它子线程的线程

2) 通常主线程最后执行完毕，主线程执行各种关闭动作


- 通过`Runnable`接口实现线程

```java

public Thread(Runnable target, String name) {
        this(null, target, name, 0);
    }

public class ChildThread implements Runnable {
    //定义一个Thread数据对象
    Thread t;
    
    public ChildThread(){
        t = new Thread(this,"create thread ChildThred");
        System.out.println("create Child Thread: "+t);
        //启动线程
        t.start();
    }
    
    //接口run()方法的实现
    public void run() {
        try {
            for (int i=5; i>0; i--) {
                System.out.println("test Thread :" + i);
                Thread.sleep(500);
            }
        } catch (InterruptedException e) {
            System.out.println("Exception ...");
        }
        
        System.out.println("exiting child thread.");
    }
}



public class TestThread {
    
    public static void main(String args[]) {
        new ChildThread();
        
        try {
                for (int i=5; i>0; i--) {
                     System.out.println("test Thread :" + i);
                     Thread.sleep(1000);
                    }
            } catch (InterruptedException e) {
                System.out.println("Exception ...");
            }  
    }
}
```

具体的就是当我们运行`TestThread`这个类的时候
1) 首先调用我们的`main()`方法
2) `new ChildThread` 创建新的`Thread`对象，这个时候走的就是`ChildThread`类的构造方法
3) 输出打印
4) `start()`方法调用，启动线程的入口方法`run()`
5) `ChildThread`类的构造方法回到`main()`方法，主线程恢复执行for循环
6) 子线程与主线程继续运行，共享CPU，直到循环结束


* 多线程之判断线程是否在运行，以及线程是否结束

接口实现`Runnable`

`````java
public class NewThread implements Runnable {
    String name;
    Thread t;
    
    public NewThread(String name) {
        this.name = name;
        t = new Thread(this,name);
        System.out.println("new thread: "t);
        t.start();
    }
    
    public void run() {
        try {
            for(int i=5; i>0; i--) {
                System.out.println(name+":"+i);
                Thread.sleep(1000);
            }
        } catch (InterruptedException e) {
            System.println(name+"Exception...");
        }
        System.out.pprintln(name+"exiting");
    }
}


//线程的实现

public class TestThread {
    
    public static void main(String args[]) {
        NewThread o1 = new NewThread("one");
        NewThread o2 = new NewThread("two");
        NewThread o3 = new NewThread("three");
        
        System.out.println("thread one is alive:"+o1.t.isAlive());
        System.out.println("thread two is alive:"+o2.t.isAlive());
        System.out.println("thread three is alive:"+o3.t.isAlive());
        
        try {
            System.out.println("waiting for thread to finish");
            o1.t.join();
            o2.t.join();
            o3.t.join();
        } catch (InterruptedException e) {
            System.out.println("main thread InterruptedException");
        }
        
        System.out.println("thread one is alive:"+o1.t.isAlive());
        System.out.println("thread two is alive:"+o2.t.isAlive());
        System.out.println("thread three is alive:"+o3.t.isAlive());
        
        System.out.println("thread three exiting");
    }
}
`````
这次我一下子创建了三个线程，分别是`o1 o2 o3`,开启了三个线程后，我们用`isAlive()`方法查看，可以发现我们返回的是`true`,也就是线程正在运行.最后三
个子线程分别交互[抢占]执行.最后执行的`join()`方法则是用来看线程是否结束.

前面我们说到，它的三个子线程是[抢占式]执行。下面我们再来看这个例子可能会更加清晰

````java
public class ChildThread implements Runnable {
    Thread t;
    String name;
    
    public ChildThread(String name) {
        t = new Thread(this,"create Thread success!!!");
        this.name = name;
    }
    
    public void run() {
        System.out.print("[-->"+name);
        try {
            Thread.sleep(500);
        } catch (InterruptedException e) {
            System.out.println("Error InterruptedException");
        }
        System.out.println("<--]");
    }
}


public class NewChild {
    
    public static void main(String args[]) {
        
        ChildThread t1 = new ChildThread("Hello");
        ChildThread t2 = new ChildThread("LiYi");
        ChildThread t3 = new ChildThread("World");
        
        try {
               System.out.println("waiting for thread to finish");
                                   t1.t.join();
                                   t2.t.join();
                                   t3.t.join();    
            } catch (InterruptedException e) {
               System.out.println("main thread InterruptedException");
            }
               System.out.println("thread three exiting");
    }
}

````

最后的输出就是：``[-->World[-->LiYi[-->Hello<--]
          <--]
          <--]
          thread three exiting``
          
          
在学习java基础的时候，看到过java关键字[synchronized],在这里我们就可以用到它了
> synchronized 关键字声明的方法同一时间只能被一个线程访问。synchronized 修饰符可以应用于四个访问修饰符。

在上面我们可以再声明一个类

```java
public class Caller {
    public synchronized void call(String msg) {
        System.out.print("[-->"+msg);
                try {
                    Thread.sleep(500);
                } catch (InterruptedException e) {
                    System.out.println("Error InterruptedException");
                }
                System.out.println("<--]");
    }
}

public class ChildThread implements Runnable {
    Thread t;
    String name;
    Caller c;
    
    public void ChildThread (Caller c,String msg){
        t = new Thread(this);
        this.c = c;
        name = msg;
        t.start();
    }
    
    public void run() {
        c.call(name);
    } 
}

public class Sync {
    
    public static void main(String args[]) {
        Caller c = new Caller();
        
        ChildThread c1 = new ChildThread(c,"Hello**");
        ChildThread c2 = new ChildThread(c,"world**");
        ChildThread c3 = new ChildThread(c,"LiYi");
        ChildThread c4 = new ChildThread(c,"HaHaHa");
        
        
         try {
                                           c1.t.join();
                                           c2.t.join();
                                           c3.t.join();    
                                           c4.t.join();
                    } catch (InterruptedException e) {
                       System.out.println("main thread InterruptedException");
                    }
                       System.out.println("thread three exiting");
    }
}
```

最后的执行结果 ``[-->Hello**<--]
          [-->HaHaHa<--]
          [-->LiYi<--]
          [-->world**<--]
          thread three exiting``
也就是我们同时有四个线程在跑。四个线程都需要调用`Caller`类的`coll`方法，在没有加关键字[synchronized]的时候,它们执行的逻辑就是

1) 打印左中括号，打印消息msg
2) 线程挂起500毫秒
3) 线程二现在接管线程，打印左中括号，打印消息msg
4) 线程二挂起500毫秒
5) 重复以上，直到挂起的线程500毫米过去，接着开始执行又中括号打印
6) 子线程执行完毕
7) 主线程执行结束

加了关键字[synchronized]就不一样了，加了它就好比加互斥锁，在我没有执行完成之前，我是不会退走的。其实还有一个`好听`的说法，就做[管程]，同时[synchronized]
还可以这样使用：

```java
//改造  Caller 类

public class Caller {
    
    public void coll(String msg){
        System.out.print("[ " + msg);
        
        try {
            Thread.sleep(500);
        } catch (InterruptedException e) {
            System.out.println("Error Message !!!");
        }
        
        System.out.println(" ]");
    }
}

// 改造ChildThread类

public class ChildThread implements Runnable {
    
    public Thread t;
    
    public String str;
    
    public Caller cc;
    
    public ChildThread(Caller c, String s) {
        cc = c;
        str = s;
        t = new Thread(this);
        t.start();
    }
    
    public void run() {
        synchronized(cc) {
            cc.coll(str)
        }
    }
}

```

最后得到的结果与之前一样 `[ Hello** ]
              [ HaHaHa ]
              [ LiYi ]
              [ world** ]
              thread three exiting`


#### 线程间同信

* `wait()` 告知被调用的线程放弃管程进入睡眠直到其它线程进入相同管程并且调用`notify()`

* `notify()` 恢复相同对象中第一个调用`wait()`的线程

* `notifyAll()` 恢复相同对象中所有调用`wait()`的线程，具有最高优先级的线程最先运行

例子：

```java
//一个简易的消息存放点
public class Queue {
    int n;
    boolean valueSet = false;
    
    public synchronized int get() {
        if (!valueSet) {
            try {
                wait();
            } catch (InterruptedException e) {
                System.out.println("Get Error");
            }
        }
        System.out.println("GET: "+n);
        valueSet = false;
        notify();
        return n;
    }
    
    public synchronized void put(int i) {
        if (valueSet) {
            try {
                 wait();
            } catch (InterruptedException e) {
                System.out.println("Error");
            }
        }
        n = i;
        valueSet = true;
        System.out.println("PUT: "+n);
        notify();
    }
}

//有一个生产者
public class Producer implements Runnable {
    Queue q;
    
    Producer (Queue q) {
        this.q = q;
        new Thread(q,"Producer").start();
    }
    
    public void run() {
        q.get();
    }
    
}

//有一个消费者
public class Consumer implements Runnable {
    Queue q;
    
    Consumer (Queue q) {
        this.q = q;
        new Thread(q,"Consumer").start();
    }
    
    public void run() {
        int i = 0;
        q.put(i++);
    }
}


//主线程调用它们
public class MainThread {

    public static void main(String args[]) {
        Queue q = new Queue();
           
        new Producer(q);
            
        new Consumer(q);
            
        System.out.println("Press Control-C to stop");
    }
    
}

```

程序大概运行逻辑：

1) 主线程`main`开始运行
2) 调起线程 `Producer`,运行`run`方法，调用`Queue`类的`put()`方法
3) 进入`Producer`管程阶段，判断`valueSet = false`值，不进入`if`,对变量赋值，改变`valueSet`值，`valueSet = true`,调用`notify()`
4) 调起线程 `Consumer`,运行`run`方法，调用`Queue`类的`get()`方法
5) 进入`Consumer`管程阶段，判断`valueSet = true`值，不进入`if`,改变`valueSet`值，`valueSet = false`,调用`notify()`，[return]返回变量，`Producer`线程被挂起
6) 重复操作

大概就是这样了，可能不太严谨

**********************************

java要学习的东西太多，加油！！！
