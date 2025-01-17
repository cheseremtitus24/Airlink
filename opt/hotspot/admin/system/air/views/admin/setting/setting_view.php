<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<script>
$(function() {
		$( "#tabs" ).tabs();
});
</script>


<div class="span8">
<?=form_open('admin/setting','id="form" class="form panel"')?>
<div class="widget_heading">
  <h4>การตั้งค่าระบบส่วนกลาง</h4>
</div>
<div class="widget_container">
  <div id="tabs" style="height:98%; text-align:left; overflow:auto;">
    <ul>
      <li><a href="#tab1">ผู้ดูแลระบบ</a></li>
      <li><a href="#tab2">การลงทะเบียน</a></li>
      <li><a href="#tab3">การเติมเงิน</a></li>
      <li><a href="#tab4">รูปแบบ Hotspot</a></li>
      <li><a href="#tab5">การใช้งานบนมือถือ</a></li>
      <li><a href="#tab6">ที่อยู่และการติดต่อ</a></li>
    </ul>
    
    <!-- เริ่มต้นแท็บที่ 1 -->
    <div id="tab1">
      <header>
        <h4>การตั้งค่าทั่วไป</h4>
      </header>
      <hr />
      <fieldset>
        <dl>
          <dt></dt>
          <dd>
            <label>Admin site name</label>
            <?=form_input(array('name'=>'admin_header','type'=>'text'),$admin_header,'')?>
          </dd>
          <dt></dt>
          <dd>
            <label>จำนวนผู้ใช้ที่สร้างได้ / ครั้ง</label>
            <?=form_input(array('name'=>'create_amount','type'=>'text'),$create_amount,'')?>
          </dd>
          <dt></dt>
           <dd>
            <label>อักษรขึ้นต้นการสร้างบัตร</label>
            <?=form_input(array('name'=>'g_userstart','type'=>'text'),$g_userstart,'')?>
          </dd>
          <dt></dt>
           <dd>
            <label>รูปแบบของรหัสผ่าน</label>
            <?=form_dropdown('g_userpass',array('numeric'=>'ตัวเลข','nozero'=>'ตัวเลขไม่มี0','alnum'=>'ตัวอักษรผสมตัวเลข','alpha'=>'ตัวอักษร'),$g_userpass)?>
          </dd>
          <dt></dt>
          <dd>
            <label>รูปแบบการเข้ารหัส</label>
            <?=form_dropdown('encryption',array('clear'=>'------','md5'=>'MD5','crypt'=>'CRYPT','md5ums'=>'MD5UMS'),$encryption)?>
          </dd>
        </dl>
        <dt></dt>
        <dd>
          <label>Force Redirect Title</label>
          <?=form_input(array('name'=>'force_redirect_title','type'=>'text'),$force_redirect_title,'')?>
        </dd>
        <dt></dt>
        <dd>
          <label>Force Redirect</label>
          <?=form_input(array('name'=>'force_redirect','type'=>'text'),$force_redirect,'')?>
        </dd>
        <dt></dt>
        <dd>
          <label>หน่วงเวลา</label>
          <?=form_input(array('name'=>'force_redirect_time','type'=>'text'),$force_redirect_time,'')?>
        </dd>
      </fieldset>
      <header>
        <h4>Debuging option</h4>
      </header>
      <hr />
      <fieldset>
        <dl>
          <dt></dt>
          <dd>
            <label>Debug mode</label>
            <?=form_dropdown('debuging',array('off'=>'OFF','on'=>'ON'),$this->session->userdata('debug'))?>
          </dd>
        </dl>
      </fieldset>
      <hr />
    </div>
    <!-- สิ้นสุดแท็บที่1--> 
    
    <!-- เริ่มต้นแท็บที่ 2-->
    <div id="tab2">
      <header>
        <h4>ตั้งค่าการลงทะเบียน</h4>
      </header>
      <hr />
      <fieldset>
        <dl>
          <? /*/<dt></dt><dd><label>ธีมลงทะเบียน</label><?=form_dropdown('themesres',$themeregis,$themesres)?></dd> */?>
          <dt></dt>
          <dd>
            <label>ไตเติ้ล</label>
            <?=form_input(array('name'=>'title_register','type'=>'text'),$title_register,'')?>
          </dd>
          <dt></dt>
          <dd>
            <label>เปิด/ปิด ระบบลงทะเบียน</label>
            <?=form_dropdown('reg_on_off',array('0'=>'OFF','1'=>'ON'),$reg_on_off)?>
          </dd>
          <dt></dt>
          <dd>
            <label>เปิดลงทะเบียนผู้ดูแลระบบ</label>
            <?=form_dropdown('admin_register',array('off'=>'ปิด','on'=>'เปิด'),$admin_register)?>
          </dd>
          <dt></dt>
          <dd>
            <label>กลุ่มที่ใช้สมัคร</label>
            <?=form_dropdown('reg_group',$sl,$reg_group)?>
          </dd>
          <dt></dt>
          <dd>
            <label>รอการยืนยัน จากระบบ</label>
            <?=form_dropdown('reg_confirm',array('Local'=>'OFF','Reject'=>'ON'),$reg_confirm)?>
          </dd>
          <!--<? //<dt></dt><dd><label>อุปกรณ์สมัครได้กี่ครั้ง</label><?=form_input(array('name'=>'time_res_mac','type'=>'number','minlength'=>'2'),$time_res_mac,' required="required"')?></dd> -->
          
        </dl>
      </fieldset>
    </div>
    <!-- สิ้นสุดแท็บที่2--> 
    
    <!-- เริ่มต้นแท็บที่ 3-->
    <div id="tab3">
      <header>
        <h4>True Money Setting </h4>
      </header>
      <hr />
      <fieldset>
        <dl>
          <dt></dt>
          <dd>
            <label>Tmtopup User ID </label>
            <?=form_input(array('name'=>'tmtopup_id','type'=>'text'),$tmtopup_id,'')?>
          </dd>
          <dt></dt>
          <dd>
            <label>API Pass Key</label>
            <?=form_input(array('name'=>'api_pass_key','type'=>'text'),$api_pass_key,'')?>
          </dd>
          <dt></dt>
          <dd></dd>
        </dl>
      </fieldset>
      <hr />
      <header>
        <h4>ค่าที่คุณต้องนำไปใส่ใน TMTOPUP.COM</h4>
      </header>
      <fieldset> 
        <dl>
          <dt></dt>
          <dd>
            <label>URL แสดงข้อความขอบคุณ</label>
            <?=form_input(array('name'=>'thank_url','type'=>'text' ),$thank_url,'readonly')?>
          </dd>
          <dt></dt>
          <dd>
            <label>API URL</label>
            <?=form_input(array('name'=>'api_url','type'=>'text'),$api_url,'readonly')?>
          </dd>
          <dt></dt>
          <dd></dd>
        </dl>
      </fieldset>
    </div>
    <!-- สิ้นสุดแท็บที่3--> 
    
    <!-- เริ่มต้นแท็บที่ 4-->
    <div id="tab4">
      <header>
        <h4>รูปแบบ</h4>
      </header>
      <hr />
      <fieldset>
        <dl>
          <dt></dt>
          <dd>
            <label>ไตเติ้ล</label>
            <?=form_input(array('name'=>'hotspot_small','type'=>'text'),$hotspot_small,'')?>
          </dd>
          <dt></dt>
          <dd>
            <label>โลโก้อักษร</label>
          <?=form_input(array('name'=>'hotspottext','type'=>'text'),$hotspottext,'')?>
          </dd>
          <dt></dt>
          <dt></dt>
          <dd>
            <label>โลโก้</label>
            <?=form_dropdown('hotspot',$logos,$hotspot)?>
          </dd>
          <dt></dt>
          <dd>
            <label>ธีมหน้าล็อกอิน</label>
            <?=form_dropdown('themes',$themeslogin,$themes)?>
          </dd>
          <dt></dt>
          <dd>
            <label>ธีมหน้าลงทะเบียน</label>
            <?=form_dropdown('registertheme',array('air'=>'air','clean'=>'clean'),$registertheme)?>
          </dd>
          <dt></dt>
          <dd>
            <label>ธีมส่วนผู้ใช้งาน</label>
            <?=form_dropdown('usertheme',array('air'=>'air','clean'=>'clean'),$usertheme)?>
          </dd>
          <dt></dt>
          <dd>
            <label>ภาษาหน้าเว็บ</label>
            <?=form_dropdown('language',array('thai'=>'ภาษาไทย','english'=>'ภาษาอังกฤษ'),$language )?>
          </dd>
          <dt></dt>
          <dd>
            <label>ป๊อบอัพธีม</label>
            <?=form_dropdown('color_themes',$theme_name,$color_themes)?>
          </dd>
          <dt></dt>
          <dd>
            <label>รูปแบบการแสดงเวลา</label>
            <?=form_dropdown('time_style',array('0'=>'แสดงเวลาขนาดใหญ่','1'=>'แสดงเวลาขนาดเล็ก'),$time_style)?>
          </dd>
          <dt></dt>
          <dd>
            <label>รูปแบบตัวเลข</label>
            <?=form_dropdown('time_number',array('0'=>'แบบปกติ','1'=>'ตัวเลขดิจิตอล','2'=>'ตัวใหญ่'),$time_number)?>
          </dd>
        </dl>
      </fieldset>
    </div>
    <!-- สิ้นสุดแท็บที่ 4--> 
    
    <!-- เริ่มต้นแท็บที่ 5-->
    
    <div id="tab5">
      <header>
        <h4>Mobile Options</h4>
      </header>
      <hr />
      <fieldset>
        <dl>
        <dt></dt>
        <dd>
          <label>โมบายธีม</label>
          <?=form_dropdown('themesmobile',$mobilelogin,$themesmobile)?>
        </dd>
         <dt></dt>
        <dd>
          <label>ธีมส่วนผู้ใช้งานมือถือ</label>
          <?=form_dropdown('thememobileview',$mobileview,$thememobileview)?>
        </dd>
        <dt></dt>
        <dd>
          <label>ไตเติ้ล</label>
          <?=form_input(array('name'=>'mobile_title','type'=>'text'),$mobile_title,'')?>
        </dd>
        <dt></dt>
        <dd>
          <label>โลโก้</label>
          <?=form_dropdown('mobilelogo',$logos,$mobilelogo)?>
        </dd>
        <dt></dt>
        <dd>
          <label>เมื่อเข้าสู่ระบบให้ไปที่</label>
          <?=form_dropdown('mobile_redirect',array('0'=>'ส่วนผู้ใช้งานสำหรับมือถือ','1'=>'URL ของผู้ใช้งาน'),$mobile_redirect)?>
        </dd>
      </fieldset>
      <header>
        <h4>ข้อความประกาศส่วนผู้ใช้งานบนโทรศัพท์</h4>
      </header>
      <hr />
      <fieldset>
        <dl>
          <dt></dt>
          <dd>
            <div id="mobile_editor" style="height:400px;">
              <?=$mobile_editor?>
            </div>
          </dd>
        </dl>
      </fieldset>
    </div>
    <!-- สิ้นสุดแท็บที่5-->
    
    <div id="tab6">
      <header>
        <h4>การติดต่อและที่อยู่</h4>
      </header>
      <hr />
      <fieldset>
        <dl>
        <dt></dt>
          <dd>
            <label>Facebook</label>
            <?=form_input(array('name'=>'facebook','type'=>'text'),$facebook,'')?>
          </dd>
          <dt></dt>
          <dt></dt>
          <dd>
            <label>GooGle+</label>
            <?=form_input(array('name'=>'google','type'=>'text'),$google,'')?>
          </dd>
          <dt></dt>
          <dt></dt>
          <dd>
            <label>Twitter</label>
            <?=form_input(array('name'=>'twitter','type'=>'text'),$twitter,'')?>
          </dd>
          <dt></dt>
          <dt></dt>
          <dd>
            <label>Blog/Website</label>
            <?=form_input(array('name'=>'blog','type'=>'text'),$blog,'')?>
          </dd>
          <dt></dt>
          
          <dt></dt>
          <dd>
            <label>ที่อยู่</label>
            <?=form_textarea(array('name'=>'address_text','type'=>'textarea','style'=>'width:50%','cols'=>'5','rows'=>'4'),$address_text,'')?>
          </dd>
          <dt></dt>
          <dd>
            <label>โทร</label>
            <?=form_input(array('name'=>'tel_text','type'=>'text'),$tel_text,'')?>
          </dd>
          <dt></dt>
          <dd>
            <label>เมล์</label>
            <?=form_input(array('name'=>'mail_text','type'=>'text'),$mail_text,'')?>
          </dd>
          <dt></dt>
          <dd>
            <label>สงวนสิทธิ์กับบุคคลที่สาม</label>
            <?=form_input(array('name'=>'copy_right','type'=>'text'),$copy_right,'')?>
          </dd>
        </dl>
      </fieldset>
      <hr />
      <fieldset>
        <dl>
          <dt></dt>
          <dd>
            <div id="editor" style="height:400px;">
              <?=$editor?>
            </div>
          </dd>
        </dl>
      </fieldset>
    </div>
    <button class="btn btn-small btn-primary " type="submit">บันทึกการตั้งค่า</button>
    </form>
  </div>
</div>
</div>
<div class="span3">
<div class="widget_heading">
  <h4>เกร็ดความรู้</h4>
</div>
<div class="widget_container"> <strong>การตั้งค่าระบบส่วนกลาง</strong> การตั้งค่านี้จะมีผลในทันที่ ที่คุณบันทึกค่าไม่มีผลใดๆต่อผู้ที่กำลังใช้งานอยู่
<br/><strong> การกำหนดอักษรนำหน้าการสร้างบัตร สามารถกำหนดได้สูงสุด 3 ตัวอักษร หากคุณกำหนดมากกว่านั้นระบบจะไม่สามารถสร้างบัตรให้คุณได้</strong>
 
  
  </div>
</div>
