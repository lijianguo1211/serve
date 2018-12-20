<?php

namespace App\Http\Controllers\Test;
use Illuminate\Support\Facades\DB;

class IndexController
{
    public function index()
    {
        (new TravelController())->go();
    }

    public function testSql()
    {
        $traf = new LegController();
        //依赖注入方式解决问题
        $tra = new IocController($traf);
        $tra->goVisit();
    }

    public function testJson()
    {
        //$req = "type=ap_2&timestamp=1545293318&data=iphoneX|||38:37:8B:F8:BD:C8|||WPA2|||PSK|||11|||-50^^^WIN-VVSP4O32A9T 0278|||A6:E9:79:FB:CE:25|||WPA2|||PSK|||11|||-71^^^Andry|||0C:72:2C:EB:55:D4|||WPA2 WPA|||PSK|||1|||-72^^^huangpu|||08:10:7A:63:F0:03|||WPA2|||PSK|||11|||-74^^^SinoGuest|||78:62:56:98:8C:2E|||WPA2|||PSK|||6|||-75^^^HUAWEI-2.4|||B8:08:D7:6B:A8:A8|||WPA2|||PSK|||7|||-70^^^  小米共享WiFi_2081|||7A:11:DC:20:20:82|||WPA2|||PSK|||7|||-69^^^|||78:62:56:98:8C:2D|||WPA2|||PSK|||6|||-75^^^sn611|||78:62:56:98:8C:2C|||WPA2|||PSK|||6|||-74^^^zhaotao|||1C:5F:2B:0B:64:B8|||WPA2|||PSK|||1|||-74^^^TP-LINK_3FF4|||30:FC:68:42:3F:F4|||WPA2 WPA|||PSK|||11|||-74^^^AP-2|||88:25:93:CB:1A:F7|||WPA2 WPA|||PSK|||13|||-74^^^604|||50:3A:A0:9E:FF:30|||WPA2|||PSK|||3|||-73^^^XBC|||08:10:7A:63:C6:69|||WPA2|||PSK|||11|||-71^^^TP-LINK_E9AA|||30:FC:68:40:E9:AA|||WPA2 WPA|||PSK|||1|||-74^^^TP-LINK_DD0B|||20:6B:E7:50:DD:0B|||WPA2|||PSK|||11|||-73^^^Xiongying123|||00:22:AA:19:3D:38|||WPA2|||PSK|||11|||-72^^^DIRECT-87-HP M130 LaserJet|||9E:30:5B:F1:A6:87|||WPA2|||PSK|||11|||-62^^^|||BC:46:99:41:B8:46|||WPA||||||11|||-74^^^HG532e-DRK8HH|||80:71:7A:5A:AA:A4|||WPA2|||PSK|||9|||-73^^^TP-LINK_0E87|||94:D9:B3:F9:0E:87|||WPA2|||PSK|||11|||-72^^^devmid2|||EC:26:CA:78:93:3E|||WPA2 WPA|||PSK|||1|||-71^^^TP-LINK_wlx|||DC:FE:18:63:35:D1|||WPA2 WPA|||PSK|||6|||-70^^^ChinaNet-3nDt|||CC:90:E8:4F:93:07|||WPA2|||PSK|||13|||-70^^^HYG02|||78:11:DC:00:20:82|||WPA2|||PSK|||7|||-71^^^MERCURY_FB6A|||50:3A:A0:5C:FB:6A|||WPA2|||PSK|||12|||-66^^^715|||A4:56:02:73:D1:BF|||WPA2|||PSK|||13|||-62^^^HUAWEI nova 3e|||EC:89:14:3E:5C:EE|||WPA2|||PSK|||1|||-60^^^TP-LINK_F2F8|||50:FA:84:73:F2:F8|||WPA2|||PSK|||2|||-59^^^FS|||78:96:82:A9:62:9F|||WPA2|||PSK|||11|||-59^^^mingjiang|||70:AF:6A:8A:10:27|||WPA2|||PSK|||1|||-58^^^ChinaNet-gRDD|||20:89:86:44:54:9A|||WPA2 WPA|||PSK|||6|||-54^^^TP-LINK_28D5|||48:7D:2E:54:28:D5|||WPA2|||PSK|||8|||-50^^^HUAWEI P20 Pro|||98:9C:57:DB:F2:04|||WPA2|||PSK|||1|||-48^^^TP-LINK_F654|||80:89:17:E6:F6:54|||WPA2 WPA|||PSK|||1|||-46^^^HUAWEI-test|||44:6E:E5:E6:5F:97|||WPA2|||PSK|||9|||-49^^^TP-LINK_C675|||20:6B:E7:2A:C6:75|||WPA2 WPA|||PSK|||1|||-35^^^Tenda_For_Test|||D8:32:14:20:31:28|||WPA2|||PSK|||5|||-36^^^回家|||90:94:97:1A:89:EF|||WPA2 OPN|||PSK|||11|||-34^^^ZRT-LZ-W01e191|||40:A5:EF:42:BA:A8|||WPA2 WPA|||PSK|||10|||-32^^^&3456|||92:F0:52:E9:C5:2C|||WPA2 WPA|||PSK|||1|||-29^^^ZRTZ_2.4G|||88:25:93:C7:D3:86|||WPA2 WPA|||PSK|||13|||-27^^^xiaomi啦啦|||E4:46:DA:FA:86:6B|||WPA2|||PSK|||11|||-23^^^WIFI_TEST|||F4:83:CD:FD:FE:24|||WPA2 WPA|||PSK|||1|||-18 ";
        //$req = "type=ap_2&timestamp=1545303623&data=715|||A4:56:02:73:D1:BF|||WPA2|||PSK|||13|||-63^^^Andry|||0C:72:2C:EB:55:D4|||WPA2 WPA|||PSK|||1|||-70^^^GGLY1|||BC:46:99:41:B8:46|||WPA2 WPA|||PSK|||11|||-72^^^zhaotao|||1C:5F:2B:0B:64:B8|||WPA2|||PSK|||1|||-77^^^sn611|||78:62:56:98:8C:2C|||WPA2|||PSK|||6|||-74^^^AP-2|||88:25:93:CB:1A:F7|||WPA2 WPA|||PSK|||13|||-76^^^|||78:62:56:98:8C:2D|||WPA2|||PSK|||6|||-75^^^TP-LINK_3FF4|||30:FC:68:42:3F:F4|||WPA2 WPA|||PSK|||11|||-75^^^FAST|||D0:C7:C0:10:05:4E|||WPA2 WPA|||PSK|||11|||-74^^^SinoGuest|||78:62:56:98:8C:2E|||WPA2|||PSK|||6|||-73^^^huangpu|||08:10:7A:63:F0:03|||WPA2|||PSK|||11|||-73^^^WHTY|||24:69:68:C2:53:5E|||WPA2 WPA|||PSK|||6|||-73^^^TP-LINK_96CB|||78:44:FD:95:96:CB|||WPA2|||PSK|||11|||-73^^^HUAWEI-2.4|||B8:08:D7:6B:A8:A8|||WPA2|||PSK|||7|||-72^^^TP-LINK_DD0B|||20:6B:E7:50:DD:0B|||WPA2|||PSK|||11|||-72^^^devmid2|||EC:26:CA:78:93:3E|||WPA2 WPA|||PSK|||1|||-72^^^XBC|||08:10:7A:63:C6:69|||WPA2|||PSK|||11|||-72^^^  小米共享WiFi_2081|||7A:11:DC:20:20:82|||WPA2|||PSK|||7|||-71^^^TP-LINK_0E87|||94:D9:B3:F9:0E:87|||WPA2|||PSK|||11|||-70^^^HYG02|||78:11:DC:00:20:82|||WPA2|||PSK|||7|||-70^^^ChinaNet-3nDt|||CC:90:E8:4F:93:07|||WPA2|||PSK|||13|||-69^^^TP-LINK_wlx|||DC:FE:18:63:35:D1|||WPA2 WPA|||PSK|||6|||-67^^^MERCURY_FB6A|||50:3A:A0:5C:FB:6A|||WPA2|||PSK|||12|||-67^^^OpenWrt|||10:66:82:81:2C:20|||OPN||||||11|||-67^^^DIRECT-87-HP M130 LaserJet|||9E:30:5B:F1:A6:87|||WPA2|||PSK|||11|||-62^^^TP-LINK_F2F8|||50:FA:84:73:F2:F8|||WPA2|||PSK|||2|||-57^^^ChinaNet-gRDD|||20:89:86:44:54:9A|||WPA2 WPA|||PSK|||6|||-54^^^mingjiang|||70:AF:6A:8A:10:27|||WPA2|||PSK|||1|||-52^^^iphoneX|||38:37:8B:F8:BD:C8|||WPA2|||PSK|||11|||-49^^^TP-LINK_28D5|||48:7D:2E:54:28:D5|||WPA2|||PSK|||8|||-46^^^TP-LINK_F654|||80:89:17:E6:F6:54|||WPA2 WPA|||PSK|||1|||-44^^^HUAWEI-test|||44:6E:E5:E6:5F:97|||WPA2|||PSK|||9|||-40^^^TP-LINK_C675|||20:6B:E7:2A:C6:75|||WPA2 WPA|||PSK|||1|||-41^^^Tenda_For_Test|||D8:32:14:20:31:28|||WPA2|||PSK|||5|||-42^^^ZRTZ_2.4G|||88:25:93:C7:D3:86|||WPA2 WPA|||PSK|||13|||-32^^^ZRT-LZ-W01e191|||40:A5:EF:42:BA:A8|||WPA2 WPA|||PSK|||10|||-24^^^WIFI_TEST|||F4:83:CD:FD:FE:24|||WPA2 WPA|||PSK|||1|||-30^^^|||EC:89:14:51:C5:C7|||WPA||||||6|||-1";
        $req = "type=ap_2&timestamp=1545303617&data=DIRECT-87-HP M130 LaserJet|||9E:30:5B:F1:A6:87|||WPA2|||PSK|||11|||-62^^^sn611|||78:62:56:98:8C:2C|||WPA2|||PSK|||6|||-74^^^TP-LINK_DD0B|||20:6B:E7:50:DD:0B|||WPA2|||PSK|||11|||-72^^^zhaotao|||1C:5F:2B:0B:64:B8|||WPA2|||PSK|||1|||-77^^^AP-2|||88:25:93:CB:1A:F7|||WPA2 WPA|||PSK|||13|||-76^^^|||78:62:56:98:8C:2D|||WPA2|||PSK|||6|||-75^^^FAST|||D0:C7:C0:10:05:4E|||WPA2 WPA|||PSK|||11|||-74^^^SinoGuest|||78:62:56:98:8C:2E|||WPA2|||PSK|||6|||-73^^^huangpu|||08:10:7A:63:F0:03|||WPA2|||PSK|||11|||-73^^^WHTY|||24:69:68:C2:53:5E|||WPA2 WPA|||PSK|||6|||-73^^^TP-LINK_96CB|||78:44:FD:95:96:CB|||WPA2|||PSK|||11|||-73^^^HUAWEI-2.4|||B8:08:D7:6B:A8:A8|||WPA2|||PSK|||7|||-73^^^devmid2|||EC:26:CA:78:93:3E|||WPA2 WPA|||PSK|||1|||-72^^^GGLY1|||BC:46:99:41:B8:46|||WPA2 WPA|||PSK|||11|||-72^^^XBC|||08:10:7A:63:C6:69|||WPA2|||PSK|||11|||-72^^^TP-LINK_3FF4|||30:FC:68:42:3F:F4|||WPA2 WPA|||PSK|||11|||-75^^^  小米共享WiFi_2081|||7A:11:DC:20:20:82|||WPA2|||PSK|||7|||-71^^^TP-LINK_0E87|||94:D9:B3:F9:0E:87|||WPA2|||PSK|||11|||-70^^^Andry|||0C:72:2C:EB:55:D4|||WPA2 WPA|||PSK|||1|||-70^^^HYG02|||78:11:DC:00:20:82|||WPA2|||PSK|||7|||-70^^^ChinaNet-3nDt|||CC:90:E8:4F:93:07|||WPA2|||PSK|||13|||-69^^^TP-LINK_wlx|||DC:FE:18:63:35:D1|||WPA2 WPA|||PSK|||6|||-68^^^MERCURY_FB6A|||50:3A:A0:5C:FB:6A|||WPA2|||PSK|||12|||-67^^^OpenWrt|||10:66:82:81:2C:20|||OPN||||||11|||-67^^^715|||A4:56:02:73:D1:BF|||WPA2|||PSK|||13|||-63^^^mingjiang|||70:AF:6A:8A:10:27|||WPA2|||PSK|||1|||-54^^^TP-LINK_F2F8|||50:FA:84:73:F2:F8|||WPA2|||PSK|||2|||-56^^^ChinaNet-gRDD|||20:89:86:44:54:9A|||WPA2 WPA|||PSK|||6|||-55^^^iphoneX|||38:37:8B:F8:BD:C8|||WPA2|||PSK|||11|||-49^^^TP-LINK_28D5|||48:7D:2E:54:28:D5|||WPA2|||PSK|||8|||-47^^^HUAWEI-test|||44:6E:E5:E6:5F:97|||WPA2|||PSK|||9|||-40^^^TP-LINK_F654|||80:89:17:E6:F6:54|||WPA2 WPA|||PSK|||1|||-44^^^TP-LINK_C675|||20:6B:E7:2A:C6:75|||WPA2 WPA|||PSK|||1|||-40^^^Tenda_For_Test|||D8:32:14:20:31:28|||WPA2|||PSK|||5|||-40^^^ZRTZ_2.4G|||88:25:93:C7:D3:86|||WPA2 WPA|||PSK|||13|||-32^^^ZRT-LZ-W01e191|||40:A5:EF:42:BA:A8|||WPA2 WPA|||PSK|||10|||-24^^^WIFI_TEST|||F4:83:CD:FD:FE:24|||WPA2 WPA|||PSK|||1|||-4^^^|||EC:89:14:51:C5:C7|||WPA||||||6|||-1";
        $data = strpos($req,'&data=');
        $data = substr($req,$data + strlen('&data='),-1);
        $data = explode('^^^', $data);
        foreach ($data as $k => $v)
        {
            echo "<pre>";
            print_r($v);
            echo "</pre>";
            $v = explode('|||', $v);
            echo "<hr />";
            echo "<pre>";
            print_r($v);
            echo "</pre>";
        }

    }
}
