import type { Patient, MedicalVisit, Prescription, InventoryItem, Invoice } from '@/Stores/dummy/type';

export const patients: Patient[] = [
  {
    id: 1,
    medicalRecordNumber: 'RM-2026-0001',
    name: 'Ahmad Fauzan',
    gender: 'male',
    birthDate: '1992-04-12',
    age: 34,
    bloodType: 'O+',
    phone: '081234567890',
    address: 'Jl. Melati No. 12, Jakarta',
    lastVisit: '2026-09-25',
    registeredAt: '2026-01-10',
  },
  {
    id: 2,
    medicalRecordNumber: 'RM-2026-0002',
    name: 'Siti Rahma',
    gender: 'female',
    birthDate: '1997-08-21',
    age: 29,
    bloodType: 'A+',
    phone: '081298765432',
    address: 'Jl. Mawar No. 7, Jakarta',
    lastVisit: '2026-09-24',
    registeredAt: '2026-01-15',
  },
  {
    id: 3,
    medicalRecordNumber: 'RM-2026-0003',
    name: 'Budi Santoso',
    gender: 'male',
    birthDate: '1986-01-18',
    age: 40,
    bloodType: 'B+',
    phone: '082112345678',
    address: 'Jl. Kenanga No. 21, Depok',
    lastVisit: '2026-09-23',
    registeredAt: '2026-02-03',
  },
  {
    id: 4,
    medicalRecordNumber: 'RM-2026-0004',
    name: 'Dewi Anggraini',
    gender: 'female',
    birthDate: '2001-11-02',
    age: 24,
    bloodType: 'AB+',
    phone: '082212345678',
    address: 'Jl. Cempaka No. 5, Jakarta',
    lastVisit: '2026-09-22',
    registeredAt: '2026-02-11',
  },
  {
    id: 5,
    medicalRecordNumber: 'RM-2026-0005',
    name: 'Rizky Maulana',
    gender: 'male',
    birthDate: '1995-06-30',
    age: 31,
    bloodType: 'O-',
    phone: '083812345678',
    address: 'Jl. Anggrek No. 19, Bekasi',
    lastVisit: '2026-09-21',
    registeredAt: '2026-03-02',
  },
];

export const medicalVisits: MedicalVisit[] = [
  {
    id: 1,
    patientId: 1,
    date: '2026-09-25',
    doctor: 'dr. Andika Pratama',
    complaint: 'Demam dan batuk sejak 2 hari',
    diagnosis: 'ISPA',
    treatment: 'Terapi simptomatik dan istirahat',
    notes: 'Pasien disarankan memperbanyak cairan.',
    vitalSigns: {
      temperature: 38.2,
      systolic: 120,
      diastolic: 80,
      heartRate: 88,
      respiratoryRate: 20,
      oxygenSaturation: 98,
      weight: 68,
      height: 170,
    },
  },
  {
    id: 2,
    patientId: 1,
    date: '2026-08-10',
    doctor: 'dr. Andika Pratama',
    complaint: 'Batuk ringan',
    diagnosis: 'Common Cold',
    treatment: 'Terapi simptomatik',
    notes: 'Kondisi umum baik.',
    vitalSigns: {
      temperature: 37.2,
      systolic: 118,
      diastolic: 78,
      heartRate: 76,
      respiratoryRate: 18,
      oxygenSaturation: 99,
      weight: 68,
      height: 170,
    },
  },
  {
    id: 3,
    patientId: 2,
    date: '2026-09-24',
    doctor: 'dr. Maya Lestari',
    complaint: 'Sakit kepala',
    diagnosis: 'Cephalgia',
    treatment: 'Analgesik dan observasi',
    notes: 'Tidak terdapat keluhan neurologis lain.',
    vitalSigns: {
      temperature: 36.8,
      systolic: 110,
      diastolic: 72,
      heartRate: 80,
      respiratoryRate: 18,
      oxygenSaturation: 99,
      weight: 55,
      height: 158,
    },
  },
];

export const prescriptions: Prescription[] = [
  {
    id: 1,
    patientId: 1,
    date: '2026-09-25',
    doctor: 'dr. Andika Pratama',
    status: 'active',
    items: [
      {
        medicine: 'Paracetamol 500 mg',
        dosage: '500 mg',
        frequency: '3 x sehari',
        quantity: 10,
        unit: 'tablet',
      },
      {
        medicine: 'Ambroxol 30 mg',
        dosage: '30 mg',
        frequency: '2 x sehari',
        quantity: 10,
        unit: 'tablet',
      },
    ],
  },
  {
    id: 2,
    patientId: 2,
    date: '2026-09-24',
    doctor: 'dr. Maya Lestari',
    status: 'completed',
    items: [
      {
        medicine: 'Paracetamol 500 mg',
        dosage: '500 mg',
        frequency: '3 x sehari',
        quantity: 6,
        unit: 'tablet',
      },
    ],
  },
];

export const inventory: InventoryItem[] = [
  {
    id: 1,
    code: 'OBT-001',
    name: 'Paracetamol 500 mg',
    category: 'Obat',
    stock: 125,
    minimumStock: 30,
    unit: 'Tablet',
    price: 500,
    status: 'available',
  },
  {
    id: 2,
    code: 'OBT-002',
    name: 'Amoxicillin 500 mg',
    category: 'Antibiotik',
    stock: 24,
    minimumStock: 30,
    unit: 'Kapsul',
    price: 1500,
    status: 'low',
  },
  {
    id: 3,
    code: 'OBT-003',
    name: 'Ambroxol 30 mg',
    category: 'Obat',
    stock: 68,
    minimumStock: 20,
    unit: 'Tablet',
    price: 750,
    status: 'available',
  },
  {
    id: 4,
    code: 'ALK-001',
    name: 'Masker Medis',
    category: 'Alkes',
    stock: 12,
    minimumStock: 50,
    unit: 'Box',
    price: 35000,
    status: 'low',
  },
  {
    id: 5,
    code: 'ALK-002',
    name: 'Sarung Tangan Medis',
    category: 'Alkes',
    stock: 0,
    minimumStock: 20,
    unit: 'Box',
    price: 45000,
    status: 'empty',
  },
];

export const invoices: Invoice[] = [
  {
    id: 1,
    invoiceNumber: 'INV-2026-0001',
    patientId: 1,
    date: '2026-09-25',
    items: [
      {
        name: 'Pemeriksaan Dokter',
        quantity: 1,
        price: 75000,
        subtotal: 75000,
      },
      {
        name: 'Paracetamol 500 mg',
        quantity: 10,
        price: 500,
        subtotal: 5000,
      },
    ],
    total: 80000,
    status: 'paid',
    paymentMethod: 'Cash',
  },
  {
    id: 2,
    invoiceNumber: 'INV-2026-0002',
    patientId: 2,
    date: '2026-09-24',
    items: [
      {
        name: 'Pemeriksaan Dokter',
        quantity: 1,
        price: 75000,
        subtotal: 75000,
      },
    ],
    total: 75000,
    status: 'pending',
  },
  {
    id: 3,
    invoiceNumber: 'INV-2026-0003',
    patientId: 3,
    date: '2026-09-23',
    items: [
      {
        name: 'Pemeriksaan Dokter',
        quantity: 1,
        price: 75000,
        subtotal: 75000,
      },
    ],
    total: 75000,
    status: 'paid',
    paymentMethod: 'QRIS',
  },
];

export function getPatient(id: number) {
  return patients.find((patient) => patient.id === id);
}

export function getPatientVisits(id: number) {
  return medicalVisits.filter((visit) => visit.patientId === id);
}

export function getPatientPrescriptions(id: number) {
  return prescriptions.filter((prescription) => prescription.patientId === id);
}

export function formatRupiah(value: number) {
  return new Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR',
    maximumFractionDigits: 0,
  }).format(value);
}
