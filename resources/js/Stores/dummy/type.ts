export type Gender = 'male' | 'female';

export type InvoiceStatus = 'paid' | 'pending' | 'cancelled';

export type StockStatus = 'available' | 'low' | 'empty';

export interface Patient {
  id: number;
  medicalRecordNumber: string;
  name: string;
  gender: Gender;
  birthDate: string;
  age: number;
  bloodType: string;
  phone: string;
  address: string;
  lastVisit: string;
  registeredAt: string;
}

export interface VitalSigns {
  temperature: number;
  systolic: number;
  diastolic: number;
  heartRate: number;
  respiratoryRate: number;
  oxygenSaturation: number;
  weight: number;
  height: number;
}

export interface MedicalVisit {
  id: number;
  patientId: number;
  date: string;
  doctor: string;
  complaint: string;
  diagnosis: string;
  treatment: string;
  notes: string;
  vitalSigns: VitalSigns;
}

export interface PrescriptionItem {
  medicine: string;
  dosage: string;
  frequency: string;
  quantity: number;
  unit: string;
}

export interface Prescription {
  id: number;
  patientId: number;
  date: string;
  doctor: string;
  items: PrescriptionItem[];
  status: 'active' | 'completed';
}

export interface InventoryItem {
  id: number;
  code: string;
  name: string;
  category: string;
  stock: number;
  minimumStock: number;
  unit: string;
  price: number;
  status: StockStatus;
}

export interface InvoiceItem {
  name: string;
  quantity: number;
  price: number;
  subtotal: number;
}

export interface Invoice {
  id: number;
  invoiceNumber: string;
  patientId: number;
  date: string;
  items: InvoiceItem[];
  total: number;
  status: InvoiceStatus;
  paymentMethod?: string;
}
