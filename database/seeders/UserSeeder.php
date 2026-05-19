<?php

namespace Database\Seeders;

use App\Models\Anggota;
use App\Models\Mahasiswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // $admin = User::create([
        //     'name' => 'Admin Pusat',
        //     'email' => 'admin@role',
        //     'password' => bcrypt('123')
        // ]);

        // $admin->assignRole('admin');

        // $superadmin = User::create([
        //     'name' => 'Super Admin',
        //     'email' => 'superadmin@role',
        //     'password' => bcrypt('123')
        // ]);

        // $superadmin->assignRole('super-admin');

        $adminRab = User::create([
            'name' => 'Admin RAB',
            'email' => 'admin@rab',
            'password' => bcrypt('rab123')
        ]);

        $adminTor = User::create([
            'name' => 'Admin TOR',
            'email' => 'admin@tor',
            'password' => bcrypt('tor123')
        ]);

        $adminRab->assignRole('admin');
        $adminTor->assignRole('admin');
        $adminRab->givePermissionTo('manage-rab');
        $adminTor->givePermissionTo('manage-tor');

        // $user = [
        //     ['id' => 1,'name' => 'Ormawa Kerohanian Islam JN UKMI','email' => 'U01@ormawa.com','password' => bcrypt('u01ormawa'),'role' => 'user'],
        //     ['id' => 2,'name' => 'Ormawa Kerohanian Islam Ilmu QurAn','email' => 'U02@ormawa.com','password' => bcrypt('u02ormawa'),'role' => 'user'],
        //     ['id' => 3,'name' => 'Ormawa Kerohanian Islam Seni Religi','email' => 'U03@ormawa.com','password' => bcrypt('u03ormawa'),'role' => 'user'],
        //     ['id' => 4,'name' => 'Ormawa Kerohanian Kristen','email' => 'U04@ormawa.com','password' => bcrypt('u04ormawa'),'role' => 'user'],
        //     ['id' => 5,'name' => 'Ormawa Kerohanian Katholik','email' => 'U05@ormawa.com','password' => bcrypt('u05ormawa'),'role' => 'user'],
        //     ['id' => 6,'name' => 'Ormawa Kerohanian Hindu','email' => 'U06@ormawa.com','password' => bcrypt('u06ormawa'),'role' => 'user'],
        //     ['id' => 7,'name' => 'Ormawa Kerohanian Budha','email' => 'U07@ormawa.com','password' => bcrypt('u07ormawa'),'role' => 'user'],
        //     ['id' => 8,'name' => 'Ormawa Kerohanian Konghucu','email' => 'U08@ormawa.com','password' => bcrypt('u08ormawa'),'role' => 'user'],
        //     ['id' => 9,'name' => 'Ormawa Badan Eksekutif Mahasiswa','email' => 'U09@ormawa.com','password' => bcrypt('u09ormawa'),'role' => 'user'],
        //     ['id' => 10,'name' => 'Ormawa Dewan Mahasiswa','email' => 'U10@ormawa.com','password' => bcrypt('u10ormawa'),'role' => 'user'],
        //     ['id' => 11,'name' => 'Ormawa Paduan Suara Mahasiswa Voca Erudita','email' => 'U11@ormawa.com','password' => bcrypt('u11ormawa'),'role' => 'user'],
        //     ['id' => 12,'name' => 'Ormawa Marching Band','email' => 'U12@ormawa.com','password' => bcrypt('u12ormawa'),'role' => 'user'],
        //     ['id' => 13,'name' => 'Ormawa Kesenian Tradisional','email' => 'U13@ormawa.com','password' => bcrypt('u13ormawa'),'role' => 'user'],
        //     ['id' => 14,'name' => 'Ormawa Pencinta Alam Garba Wira Bhuana','email' => 'U14@ormawa.com','password' => bcrypt('u14ormawa'),'role' => 'user'],
        //     ['id' => 15,'name' => 'Ormawa Korps Sukarela Palang Merah Indonesia','email' => 'U16@ormawa.com','password' => bcrypt('u16ormawa'),'role' => 'user'],
        //     ['id' => 16,'name' => 'Ormawa Gerakan Pramuka Gudep Kota Surakarta ','email' => 'U17@ormawa.com','password' => bcrypt('u17ormawa'),'role' => 'user'],
        //     ['id' => 17,'name' => 'Ormawa Pusat Informasi dan Komunikasi Remaja','email' => 'U18@ormawa.com','password' => bcrypt('u18ormawa'),'role' => 'user'],
        //     ['id' => 18,'name' => 'Ormawa Studi Ilmiah Mahasiswa','email' => 'U19@ormawa.com','password' => bcrypt('u19ormawa'),'role' => 'user'],
        //     ['id' => 19,'name' => 'Ormawa Student English Forum','email' => 'U20@ormawa.com','password' => bcrypt('u20ormawa'),'role' => 'user'],
        //     ['id' => 20,'name' => 'Ormawa Aisec','email' => 'U21@ormawa.com','password' => bcrypt('u21ormawa'),'role' => 'user'],
        //     ['id' => 21,'name' => 'Ormawa Lembaga Pers Mahasiswa Kentingan','email' => 'U22@ormawa.com','password' => bcrypt('u22ormawa'),'role' => 'user'],
        //     ['id' => 22,'name' => 'Ormawa Robotika','email' => 'U23@ormawa.com','password' => bcrypt('u23ormawa'),'role' => 'user'],
        //     ['id' => 23,'name' => 'Ormawa Koperasi Mahasiswa','email' => 'U24@ormawa.com','password' => bcrypt('u24ormawa'),'role' => 'user'],
        //     ['id' => 24,'name' => 'Ormawa INKAI','email' => 'U25@ormawa.com','password' => bcrypt('u25ormawa'),'role' => 'user'],
        //     ['id' => 25,'name' => 'Ormawa Sorinji Kempo','email' => 'U26@ormawa.com','password' => bcrypt('u26ormawa'),'role' => 'user'],
        //     ['id' => 26,'name' => 'Ormawa Taekwondo','email' => 'U27@ormawa.com','password' => bcrypt('u27ormawa'),'role' => 'user'],
        //     ['id' => 27,'name' => 'Ormawa Pencak Silat Merpati Putih','email' => 'U28@ormawa.com','password' => bcrypt('u28ormawa'),'role' => 'user'],
        //     ['id' => 28,'name' => 'Ormawa Pencak Silat Tapak Suci','email' => 'U29@ormawa.com','password' => bcrypt('u29ormawa'),'role' => 'user'],
        //     ['id' => 29,'name' => 'Ormawa Pencak Silat Perisai Diri','email' => 'U30@ormawa.com','password' => bcrypt('u30ormawa'),'role' => 'user'],
        //     ['id' => 30,'name' => 'Ormawa Pencak Silat PSHT','email' => 'U31@ormawa.com','password' => bcrypt('u31ormawa'),'role' => 'user'],
        //     ['id' => 31,'name' => 'Ormawa Sepakbola dan Futsal','email' => 'U32@ormawa.com','password' => bcrypt('u32ormawa'),'role' => 'user'],
        //     ['id' => 32,'name' => 'Ormawa Bola Basket','email' => 'U33@ormawa.com','password' => bcrypt('u33ormawa'),'role' => 'user'],
        //     ['id' => 33,'name' => 'Ormawa Bola Voli','email' => 'U34@ormawa.com','password' => bcrypt('u34ormawa'),'role' => 'user'],
        //     ['id' => 34,'name' => 'Ormawa Bulutangkis','email' => 'U35@ormawa.com','password' => bcrypt('u35ormawa'),'role' => 'user'],
        //     ['id' => 35,'name' => 'Ormawa Tenis Lapangan','email' => 'U36@ormawa.com','password' => bcrypt('u36ormawa'),'role' => 'user'],
        //     ['id' => 36,'name' => 'Ormawa Tenis Meja','email' => 'U37@ormawa.com','password' => bcrypt('u37ormawa'),'role' => 'user'],
        //     ['id' => 37,'name' => 'Ormawa Komadiksi Smart','email' => 'U38@ormawa.com','password' => bcrypt('u38ormawa'),'role' => 'user'],
        //     ['id' => 38,'name' => 'Ormawa Pentaque','email' => 'U39@ormawa.com','password' => bcrypt('u39ormawa'),'role' => 'user'],
        //     ['id' => 39,'name' => 'Ormawa HMP Pascasarjana','email' => 'U40@ormawa.com','password' => bcrypt('u40ormawa'),'role' => 'user'],
        //     ['id' => 40,'name' => 'Ormawa Society of Renewable Energy','email' => 'U41@ormawa.com','password' => bcrypt('u41ormawa'),'role' => 'user'],
        //     ['id' => 41,'name' => 'Ormawa Judo','email' => 'U42@ormawa.com','password' => bcrypt('u42ormawa'),'role' => 'user'],
        //     ['id' => 42,'name' => 'Ormawa Pagar Nusa','email' => 'U43@ormawa.com','password' => bcrypt('u43ormawa'),'role' => 'user'],
        //     ['id' => 43,'name' => 'Ormawa E-Sport','email' => 'U44@ormawa.com','password' => bcrypt('u44ormawa'),'role' => 'user'],
        //     ['id' => 44,'name' => 'Ormawa Aquatic','email' => 'U45@ormawa.com','password' => bcrypt('u45ormawa'),'role' => 'user'],
        //     ['id' => 45,'name' => 'Ormawa Sepak Takraw','email' => 'U46@ormawa.com','password' => bcrypt('u46ormawa'),'role' => 'user'],
        //     ['id' => 46,'name' => 'Ormawa Bengawan Team','email' => 'U47@ormawa.com','password' => bcrypt('u47ormawa'),'role' => 'user'],
        //     ['id' => 47,'name' => 'Ormawa Catur','email' => 'U48@ormawa.com','password' => bcrypt('u48ormawa'),'role' => 'user'],
        //     ['id' => 48,'name' => 'Non-Ormawa','email' => 'U99@ormawa.com','password' => bcrypt('u99ormawa'),'role' => 'user'],
        //     ['id' => 49,'name' => 'Ormawa Futsal','email' => 'U49@ormawa.com','password' => bcrypt('u49ormawa'),'role' => 'user'],
        //     ['id' => 50,'name' => 'Ormawa Atletik','email' => 'U50@ormawa.com','password' => bcrypt('u50ormawa'),'role' => 'user'],
        //     ['id' => 51,'name' => 'Ormawa Kesusastraan','email' => 'U51@ormawa.com','password' => bcrypt('u51ormawa'),'role' => 'user'],
        //     ['id' => 52,'name' => 'Ormawa UNS Consulting Club','email' => 'U52@ormawa.com','password' => bcrypt('u52ormawa'),'role' => 'user'],
        //     ['id' => 53,'name' => 'Ormawa Ideas Lab UNS','email' => 'U53@ormawa.com','password' => bcrypt('u53ormawa'),'role' => 'user'],
        //     ['id' => 54,'name' => 'Ormawa Forum Relawan Untuk Mahasiswa Disabilitas','email' => 'U54@ormawa.com','password' => bcrypt('u54ormawa'),'role' => 'user'],
        // ];

        // $pembina = [
        //     ['id' => 1,'name' => 'Pembina Kerohanian Islam JN UKMI', 'email' => 'U01@pembina.com', 'password' => bcrypt('u01pembina')],
        //     ['id' => 2,'name' => 'Pembina Kerohanian Islam Ilmu QurAn', 'email' => 'U02@pembina.com', 'password' => bcrypt('u02pembina')],
        //     ['id' => 3,'name' => 'Pembina Kerohanian Islam Seni Religi', 'email' => 'U03@pembina.com', 'password' => bcrypt('u03pembina')],
        //     ['id' => 4,'name' => 'Pembina Kerohanian Kristen', 'email' => 'U04@pembina.com', 'password' => bcrypt('u04pembina')],
        //     ['id' => 5,'name' => 'Pembina Kerohanian Katholik', 'email' => 'U05@pembina.com', 'password' => bcrypt('u05pembina')],
        //     ['id' => 6,'name' => 'Pembina Kerohanian Hindu', 'email' => 'U06@pembina.com', 'password' => bcrypt('u06pembina')],
        //     ['id' => 7,'name' => 'Pembina Kerohanian Budha', 'email' => 'U07@pembina.com', 'password' => bcrypt('u07pembina')],
        //     ['id' => 8,'name' => 'Pembina Kerohanian Konghucu', 'email' => 'U08@pembina.com', 'password' => bcrypt('u08pembina')],
        //     ['id' => 9,'name' => 'Pembina Badan Eksekutif Mahasiswa', 'email' => 'U09@pembina.com', 'password' => bcrypt('u09pembina')],
        //     ['id' => 10,'name' => 'Pembina Dewan Mahasiswa', 'email' => 'U10@pembina.com', 'password' => bcrypt('u10pembina')],
        //     ['id' => 11,'name' => 'Pembina Paduan Suara Mahasiswa Voca Erudita', 'email' => 'U11@pembina.com', 'password' => bcrypt('u11pembina')],
        //     ['id' => 12,'name' => 'Pembina Marching Band', 'email' => 'U12@pembina.com', 'password' => bcrypt('u12pembina')],
        //     ['id' => 13,'name' => 'Pembina Kesenian Tradisional', 'email' => 'U13@pembina.com', 'password' => bcrypt('u13pembina')],
        //     ['id' => 14,'name' => 'Pembina Pencinta Alam Garba Wira Bhuana', 'email' => 'U14@pembina.com', 'password' => bcrypt('u14pembina')],
        //     ['id' => 15,'name' => 'Pembina Korps Sukarela Palang Merah Indonesia', 'email' => 'U16@pembina.com', 'password' => bcrypt('u16pembina')],
        //     ['id' => 16,'name' => 'Pembina Gerakan Pramuka Gudep Kota Surakarta ', 'email' => 'U17@pembina.com', 'password' => bcrypt('u17pembina')],
        //     ['id' => 17,'name' => 'Pembina Pusat Informasi dan Komunikasi Remaja', 'email' => 'U18@pembina.com', 'password' => bcrypt('u18pembina')],
        //     ['id' => 18,'name' => 'Pembina Studi Ilmiah Mahasiswa', 'email' => 'U19@pembina.com', 'password' => bcrypt('u19pembina')],
        //     ['id' => 19,'name' => 'Pembina Student English Forum', 'email' => 'U20@pembina.com', 'password' => bcrypt('u20pembina')],
        //     ['id' => 20,'name' => 'Pembina Aisec', 'email' => 'U21@pembina.com', 'password' => bcrypt('u21pembina')],
        //     ['id' => 21,'name' => 'Pembina Lembaga Pers Mahasiswa Kentingan', 'email' => 'U22@pembina.com', 'password' => bcrypt('u22pembina')],
        //     ['id' => 22,'name' => 'Pembina Robotika', 'email' => 'U23@pembina.com', 'password' => bcrypt('u23pembina')],
        //     ['id' => 23,'name' => 'Pembina Koperasi Mahasiswa', 'email' => 'U24@pembina.com', 'password' => bcrypt('u24pembina')],
        //     ['id' => 24,'name' => 'Pembina INKAI', 'email' => 'U25@pembina.com', 'password' => bcrypt('u25pembina')],
        //     ['id' => 25,'name' => 'Pembina Sorinji Kempo', 'email' => 'U26@pembina.com', 'password' => bcrypt('u26pembina')],
        //     ['id' => 26,'name' => 'Pembina Taekwondo', 'email' => 'U27@pembina.com', 'password' => bcrypt('u27pembina')],
        //     ['id' => 27,'name' => 'Pembina Pencak Silat Merpati Putih', 'email' => 'U28@pembina.com', 'password' => bcrypt('u28pembina')],
        //     ['id' => 28,'name' => 'Pembina Pencak Silat Tapak Suci', 'email' => 'U29@pembina.com', 'password' => bcrypt('u29pembina')],
        //     ['id' => 29,'name' => 'Pembina Pencak Silat Perisai Diri', 'email' => 'U30@pembina.com', 'password' => bcrypt('u30pembina')],
        //     ['id' => 30,'name' => 'Pembina Pencak Silat PSHT', 'email' => 'U31@pembina.com', 'password' => bcrypt('u31pembina')],
        //     ['id' => 31,'name' => 'Pembina Sepakbola dan Futsal', 'email' => 'U32@pembina.com', 'password' => bcrypt('u32pembina')],
        //     ['id' => 32,'name' => 'Pembina Bola Basket', 'email' => 'U33@pembina.com', 'password' => bcrypt('u33pembina')],
        //     ['id' => 33,'name' => 'Pembina Bola Voli', 'email' => 'U34@pembina.com', 'password' => bcrypt('u34pembina')],
        //     ['id' => 34,'name' => 'Pembina Bulutangkis', 'email' => 'U35@pembina.com', 'password' => bcrypt('u35pembina')],
        //     ['id' => 35,'name' => 'Pembina Tenis Lapangan', 'email' => 'U36@pembina.com', 'password' => bcrypt('u36pembina')],
        //     ['id' => 36,'name' => 'Pembina Tenis Meja', 'email' => 'U37@pembina.com', 'password' => bcrypt('u37pembina')],
        //     ['id' => 37,'name' => 'Pembina Komadiksi Smart', 'email' => 'U38@pembina.com', 'password' => bcrypt('u38pembina')],
        //     ['id' => 38,'name' => 'Pembina Pentaque', 'email' => 'U39@pembina.com', 'password' => bcrypt('u39pembina')],
        //     ['id' => 39,'name' => 'Pembina HMP Pascasarjana', 'email' => 'U40@pembina.com', 'password' => bcrypt('u40pembina')],
        //     ['id' => 40,'name' => 'Pembina Society of Renewable Energy', 'email' => 'U41@pembina.com', 'password' => bcrypt('u41pembina')],
        //     ['id' => 41,'name' => 'Pembina Judo', 'email' => 'U42@pembina.com', 'password' => bcrypt('u42pembina')],
        //     ['id' => 42,'name' => 'Pembina Pagar Nusa', 'email' => 'U43@pembina.com', 'password' => bcrypt('u43pembina')],
        //     ['id' => 43,'name' => 'Pembina E-Sport', 'email' => 'U44@pembina.com', 'password' => bcrypt('u44pembina')],
        //     ['id' => 44,'name' => 'Pembina Aquatic', 'email' => 'U45@pembina.com', 'password' => bcrypt('u45pembina')],
        //     ['id' => 45,'name' => 'Pembina Sepak Takraw', 'email' => 'U46@pembina.com', 'password' => bcrypt('u46pembina')],
        //     ['id' => 46,'name' => 'Pembina Bengawan Team', 'email' => 'U47@pembina.com', 'password' => bcrypt('u47pembina')],
        //     ['id' => 47,'name' => 'Pembina Catur', 'email' => 'U48@pembina.com', 'password' => bcrypt('u48pembina')],
        //     ['id' => 48,'name' => 'Non-Pembina', 'email' => 'U99@pembina.com', 'password' => bcrypt('u99pembina')],
        //     ['id' => 49,'name' => 'Pembina Futsal', 'email' => 'U49@pembina.com', 'password' => bcrypt('u49pembina')],
        //     ['id' => 50,'name' => 'Pembina Atletik', 'email' => 'U50@pembina.com', 'password' => bcrypt('u50pembina')],
        //     ['id' => 51,'name' => 'Pembina Kesusastraan', 'email' => 'U51@pembina.com', 'password' => bcrypt('u51pembina')],
        //     ['id' => 52,'name' => 'Pembina UNS Consulting Club', 'email' => 'U52@pembina.com', 'password' => bcrypt('u52pembina')],
        //     ['id' => 53,'name' => 'Pembina Ideas Lab UNS', 'email' => 'U53@pembina.com', 'password' => bcrypt('u53pembina')],
        //     ['id' => 54,'name' => 'Pembina Forum Relawan Untuk Mahasiswa Disabilitas', 'email' => 'U54@pembina.com', 'password' => bcrypt('u54pembina')],
        // ];

        // foreach ($pembina as $p) {
        //     $newPembina = User::create([
        //         'name' => $p['name'],
        //         'email' => $p['email'],
        //         'password' => $p['password'],
        //     ]);

        //     Anggota::create([
        //         'user_id' => $newPembina->id,
        //         'ormawa_id' => $p['id'],
        //         'jabatan' => 'Pembina',
        //     ]);

        //     $newPembina->assignRole('user');
        //     $newPembina->givePermissionTo('pembina-ormawa');
            
        //     }

        // foreach ($user as $u) {
        //     $newUser = User::create([
        //         'name' => $u['name'],
        //         'email' => $u['email'],
        //         'password' => $u['password'],
        //     ]);

        //     Anggota::create([
        //         'user_id' => $newUser->id,
        //         'ormawa_id' => $u['id'],
        //         'jabatan' => 'Ketua Ormawa',
        //     ]);

        //     $newUser->assignRole($u['role']);
        //     $newUser->givePermissionTo('ketua-ormawa');
        // }

    }
}
