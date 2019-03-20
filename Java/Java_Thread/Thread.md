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
这次我一下子创建了三个线程，分别是`o1 o2 o3`,开启了三个线程后，我们用`isAlive()`方法查看，可以发现我们返回的是`true`
也就是线程正在运行.最后三个子线程分别交互[抢占]执行.最后执行的`join()`方法则是用来看线程是否结束




